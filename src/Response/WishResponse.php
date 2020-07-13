<?php
declare(strict_types=1);

namespace App\Response;

use Domain\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class EntityResponse
 * @package App\Response
 */
class WishResponse extends JsonResponse
{
    protected Entity $entity;

    public function __construct(WishDto $entity, int $status = JsonResponse::HTTP_OK)
    {
        parent::__construct($entity, $status);
    }
}
