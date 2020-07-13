<?php
declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class EmptyResponse
 * @package App\Response
 */
class EmptyResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
