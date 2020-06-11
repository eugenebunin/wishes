<?php
declare(strict_types=1);

namespace Domain;

use DateTime;
use Domain\Exceptions\ModificationNotAllowed;
use Domain\Exceptions\TransitionNotAllowed;
use Domain\State\Created;
use Domain\State\State;

/**
 * Class Entity
 * @package Domain
 */
class Entity
{
    private Id $id;
    private Title $title;
    private Price $price;
    private State $state;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(Id $id, Title $title, Price $price, State $state, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(Id $id, Title $title, Price $price): self
    {
        return new static($id, $title, $price, new Created(), new DateTime(), new DateTime());
    }

    /**
     * @param State $state
     * @throws TransitionNotAllowed
     */
    public function moveTo(State $state)
    {
        $this->validateTransition($state);
        $this->state = $state;
        $this->updatedAt = new DateTime();
    }

    /**
     * @param Title $title
     * @param Price $price
     * @throws ModificationNotAllowed
     */
    public function update(Title $title, Price $price): void
    {
        if (!$this->state->canUpdate()) {
            throw new ModificationNotAllowed();
        }
        $this->title = $title;
        $this->price = $price;
        $this->updatedAt = new DateTime();
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param State $state
     * @throws TransitionNotAllowed
     */
    private function validateTransition(State $state): void
    {
        if (!$this->state->canMoveTo($state)) {
            throw new TransitionNotAllowed();
        }
    }
}
