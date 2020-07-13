<?php
declare(strict_types=1);

namespace App\Response;

use DateTime;
use Domain\Entity;
use JsonSerializable;

/**
 * Class WishDto
 * @package App\Response
 */
class WishDto implements JsonSerializable
{
    protected Entity $entity;
    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    public function jsonSerialize()
    {
        return [
            'id' => (string)$this->entity->getId(),
            'title' => $this->entity->getTitle()->value(),
            'price' => $this->entity->getPrice()->value(),
            'state' => $this->entity->getState()->slug(),
            'createdAt' => $this->entity->getCreatedAt()->format(DateTime::ATOM),
            'updatedAt' => $this->entity->getUpdatedAt()->format(DateTime::ATOM),
        ];
    }
}
