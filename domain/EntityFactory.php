<?php
declare(strict_types=1);

namespace Domain;

use DateTime;
use Domain\State\Created;
use Domain\State\Factory;
use Domain\State\State;

/**
 * Class EntityFactory
 * @package Domain
 */
class EntityFactory
{
    protected Id $id;

    /**
     * @param Id $id
     * @param string $title
     * @param string $price
     * @return Entity
     * @throws Exceptions\InvalidFormat
     */
    public function make(Id $id, string $title, string $price): Entity
    {
        return new Entity($id, new Title($title), new Price(floatval($price)), $this->getState(), new DateTime(), new DateTime());
    }

    public function withDefaultPrice($id, Title $title): Entity
    {
        return new Entity($id, $title, Price::default(), $this->getState(), new DateTime(), new DateTime());
    }

    public function fromPersistenceMapper(): callable
    {
        return function (Id $id, string $title, string $price, int $state, DateTime $createdAt, DateTime $updatedAt) {
            return new Entity($id, new Title($title), new Price(floatval($price)), Factory::make($state), $createdAt, $updatedAt);
        };
    }

    protected function getState(): State
    {
        return new Created();
    }
}
