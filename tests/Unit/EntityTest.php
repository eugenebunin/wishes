<?php
declare(strict_types=1);

namespace App\Tests\Unit;

use App\WishId;
use Domain\Exceptions\ModificationNotAllowed;
use Domain\Exceptions\TransitionNotAllowed;
use Domain\EntityFactory;
use Domain\Price;
use Domain\State\Archived;
use Domain\State\Created;
use Domain\State\Obtained;
use Domain\Title;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    /**
     * @throws ModificationNotAllowed
     * @throws TransitionNotAllowed
     */
    public function testCantUpdate()
    {
        $this->expectException(ModificationNotAllowed::class);
        $id = WishId::random();
        $factory = new EntityFactory();
        $item = $factory->withDefaultPrice($id, new Title('Empty'));
        $item->moveTo(new Obtained());
        $item->moveTo(new Archived());
        $item->update(new Title('Fake'), Price::default());
    }

    /**
     * @throws TransitionNotAllowed
     */
    public function testCantMove()
    {
        $this->expectException(TransitionNotAllowed::class);
        $id = WishId::random();
        $factory = new EntityFactory();
        $item = $factory->withDefaultPrice($id, new Title('Empty'));
        $item->moveTo(new Archived());
        $item->moveTo(new Created());
    }

    /**
     * @throws ModificationNotAllowed
     */
    public function testCanUpdate()
    {
        $id = WishId::random();
        $factory = new EntityFactory();
        $item = $factory->withDefaultPrice($id, new Title('Empty'));
        $title = new Title('Fake');
        $item->update(new Title('Fake'), Price::default());
        $this->assertEquals($item->getTitle()->value(), $title->value());
    }
}
