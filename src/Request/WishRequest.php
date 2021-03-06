<?php
declare(strict_types=1);

namespace App\Request;

use App\WishId;
use Domain\Entity;
use Domain\Id;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WishRequest
 * @package App\Request
 */
abstract class WishRequest extends BaseRequest
{
    protected string $id;

    public function __construct(string $id, Request $request)
    {
        $this->id = $id;
        parent::__construct($request);
    }

    protected function makeId(): Id
    {
        return WishId::random();
    }

    protected function getTitle(): string
    {
        return $this->input->get('title');
    }

    protected function getPrice(): string
    {
        return (string)$this->input->get('price');
    }

    abstract public function entity(): Entity;
}
