<?php
declare(strict_types=1);

namespace App\Controller;

use App\CreateRequest;
use App\MoveRequest;
use App\StateEnum;
use App\UpdateRequest;
use App\WishId;
use App\Response;
use Domain\Exceptions\DomainException;
use Domain\Exceptions\InvalidFormat;
use Domain\Exceptions\TransitionNotAllowed;
use Domain\Repository;
use Domain\State\Factory;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        return new Response($entity);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws InvalidFormat
     */
    public function create(Request $request)
    {
        $createRequest = new CreateRequest($request);
        $entity = $createRequest->entity();
        $this->wishes->create($entity);
        return new Response($entity, JsonResponse::HTTP_CREATED);
    }

    public function delete(string $id)
    {
        $this->wishes->delete(new WishId($id));
        return new JsonResponse();
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Response
     * @throws InvalidFormat
     */
    public function update(string $id, Request $request)
    {
        $entity = (new UpdateRequest($id, $request))->entity();
        $this->wishes->update($entity);
        return new Response($entity);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Response
     * @throws TransitionNotAllowed
     * @throws DomainException
     */
    public function move(string $id, Request $request)
    {
        $move = new MoveRequest($id, $request, $this->wishes);
        $entity = $move->entity();
        $entity->moveTo($move->getState());
        $this->wishes->update($entity);
        return new Response($entity);
    }
}
