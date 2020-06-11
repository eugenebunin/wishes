<?php
declare(strict_types=1);

namespace App;

use Domain\Id;

/**
 * Class WishId
 * @package App
 */
class WishId implements Id
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function random(): Id
    {
        $id = uuid_create(UUID_TYPE_RANDOM);
        return new static($id);
    }

    public function __toString()
    {
        return $this->id;
    }
}
