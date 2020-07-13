<?php
declare(strict_types=1);

namespace App\Response;

use Domain\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CollectionResponse
 * @package App
 */
class CollectionResponse extends JsonResponse
{
    /**
     * CollectionResponse constructor.
     * @param Entity[] $collection
     * @param int $status
     */
    public function __construct(array $collection, int $status = JsonResponse::HTTP_OK)
    {
        parent::__construct($this->normalizeCollection($collection), $status);
    }

    private function normalizeCollection(array $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = new WishDto($item);
        }
        return $result;
    }
}
