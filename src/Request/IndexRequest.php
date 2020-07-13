<?php
declare(strict_types=1);

namespace App\Request;

use App\QueryFactory;
use Domain\Query;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexRequest
 * @package App\Request
 */
class IndexRequest extends BaseRequest
{
    private QueryFactory $queryFactory;

    public function __construct(Request $request, QueryFactory $queryFactory)
    {
        parent::__construct($request);
        $this->queryFactory = $queryFactory;
    }

    public function query(): Query
    {
        return $this->queryFactory->make();
    }
}
