<?php
declare(strict_types=1);

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class BaseRequest
 * @package App\Request
 */
class BaseRequest
{
    protected InputBag $input;
    protected InputBag $query;
    protected ParameterBag $routeParams;

    public function __construct(Request $request)
    {
        $this->input = new InputBag(json_decode($request->getContent(), true)??[]);
        $this->query = $request->query;
        $attributes = $request->attributes->all();
        $this->routeParams = new ParameterBag($attributes['_route_params']??[]);
    }
}
