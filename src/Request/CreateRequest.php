<?php
declare(strict_types=1);

namespace App\Request;

use App\WishId;
use Domain\Entity;
use Domain\EntityFactory;
use Domain\Exceptions\InvalidFormat;
use Symfony\Component\HttpFoundation\Request;
use Domain\Id;
use Symfony\Component\HttpFoundation\InputBag;

/**
 * Class CreateRequest
 * @package App\Request
 */
class CreateRequest extends BaseRequest
{
    private EntityFactory $factory;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->factory = new EntityFactory();
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

    /**
     * @return Entity
     * @throws InvalidFormat
     */
    public function entity(): Entity
    {
        return $this->factory->make($this->makeId(), $this->getTitle(), $this->getPrice());
    }
}
