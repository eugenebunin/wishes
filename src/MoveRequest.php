<?php
declare(strict_types=1);

namespace App;

use Domain\Entity;
use Domain\Exceptions\DomainException;
use Domain\Repository;
use Domain\State\Factory;
use Domain\State\State;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MoveRequest
 * @package App
 */
class MoveRequest extends JsonRequest
{
    private Repository $wishes;
    private string $id;

    public function __construct(string $id, Request $request, Repository $wishes)
    {
        $this->wishes = $wishes;
        $this->id = $id;
        parent::__construct($request);
    }

    public function entity(): Entity
    {
        return $this->wishes->find(new WishId($this->id));
    }

    /**
     * @return State
     * @throws DomainException
     */
    public function getState(): State
    {
        $attributes = $this->attributes->all();
        $state = $attributes['_route_params']['slug'];
        return Factory::make(StateEnum::key($state));
    }
}
