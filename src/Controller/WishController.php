<?php
declare(strict_types=1);

namespace App\Controller;

use App\Response\CollectionResponse;
use App\Request\CreateRequest;
use App\Response\EmptyResponse;
use App\Request\MoveRequest;
use App\QueryFactory;
use App\Request\UpdateRequest;
use App\WishDto;
use App\WishId;
use App\Response\WishResponse;
use Domain\Exceptions\DomainException;
use Domain\Exceptions\InvalidFormat;
use Domain\Exceptions\TransitionNotAllowed;
use Domain\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Request\IndexRequest;

/**
 * Class WishController
 * @package App\Controller
 */
class WishController extends AbstractController
{
    private Repository $wishes;

    public function __construct(Repository $wishes)
    {
        $this->wishes = $wishes;
    }

    public function show(string $id)
    {
        $entity = $this->wishes->find(new WishId($id));
        return new WishResponse(new WishDto($entity));
    }

    /**
     * @param Request $request
     * @return WishResponse
     * @throws InvalidFormat
     */
    public function create(Request $request)
    {
        $createRequest = new CreateRequest($request);
        $entity = $createRequest->entity();
        $this->wishes->create($entity);
        return new WishResponse(new WishDto($entity), JsonResponse::HTTP_CREATED);
    }

    public function delete(string $id)
    {
        $this->wishes->delete(new WishId($id));
        return new EmptyResponse();
    }

    /**
     * @param string $id
     * @param Request $request
     * @return WishResponse
     * @throws InvalidFormat
     */
    public function update(string $id, Request $request)
    {
        $entity = (new UpdateRequest($id, $request))->entity();
        $this->wishes->update($entity);
        return new WishResponse(new WishDto($entity));
    }

    /**
     * @param string $id
     * @param Request $request
     * @return WishResponse
     * @throws TransitionNotAllowed
     * @throws DomainException
     */
    public function move(string $id, Request $request)
    {
        $move = new MoveRequest($id, $request, $this->wishes);
        $entity = $move->entity();
        $entity->moveTo($move->getState());
        $this->wishes->update($entity);
        return new WishResponse(new WishDto($entity));
    }

    /**
     * @param Request $request
     * @param QueryFactory $queryFactory
     * @return CollectionResponse
     */
    public function index(Request $request, QueryFactory $queryFactory)
    {
        $query = (new IndexRequest($request, $queryFactory))->query();
        return new CollectionResponse($this->wishes->fetch($query));
    }
}
