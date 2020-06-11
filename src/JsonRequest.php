<?php
declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class JsonRequest
 * @package App
 */
class JsonRequest
{
    protected InputBag $input;
    protected InputBag $query;
    protected ParameterBag $attributes;

    public function __construct(Request $request)
    {
        $this->input = new InputBag(json_decode($request->getContent(), true)??[]);
        $this->query = $request->query;
        $this->attributes = $request->attributes;
    }
}
