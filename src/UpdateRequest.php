<?php
declare(strict_types=1);

namespace App;

use Domain\Entity;
use Domain\EntityFactory;
use Domain\Exceptions\InvalidFormat;
use Domain\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;

/**
 * Class UpdateRequest
 * @package App
 */
class UpdateRequest extends WishRequest
{
    private EntityFactory $factory;
    protected string $id;

    public function __construct(string $id, Request $request)
    {
        parent::__construct($id, $request);
        $this->factory = new EntityFactory();
        $this->id = $id;
    }

    /**
     * @return Entity
     * @throws InvalidFormat
     */
    public function entity(): Entity
    {
        return $this->factory->make($this->makeId(), $this->getTitle(), $this->getPrice());
    }

    protected function makeId(): Id
    {
        return new WishId($this->id);
    }
}
