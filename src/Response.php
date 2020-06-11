<?php
declare(strict_types=1);

namespace App;

use DateTime;
use Domain\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Response
 * @package App
 */
class Response extends JsonResponse
{
    protected Entity $entity;

    public function __construct(Entity $entity, int $status = JsonResponse::HTTP_OK)
    {
        $data = [
            'id' => (string)$entity->getId(),
            'title' => $entity->getTitle()->value(),
            'state' => $entity->getState()->slug(),
            'price' => $entity->getPrice()->value(),
            'createdAt' => $entity->getCreatedAt()->format(DateTime::ATOM),
            'updatedAt' => $entity->getUpdatedAt()->format(DateTime::ATOM)
        ];
        parent::__construct($data, $status);
    }
}
