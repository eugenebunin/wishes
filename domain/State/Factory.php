<?php
declare(strict_types=1);

namespace Domain\State;

use Domain\Exceptions\DomainException;

/**
 * Class Factory
 * @package Domain\State
 */
class Factory
{
    /**
     * @var array|string[]
     */
    protected static array $map = [
        1 => Created::class,
        2 => Obtained::class,
        3 => Archived::class,
    ];

    /**
     * @param int $key
     * @return State
     * @throws DomainException
     */
    public static function make(int $key): State
    {
        if (array_key_exists($key, self::$map)) {
            $class = self::$map[$key];
            return new $class;
        }
        throw new DomainException(sprintf('wrong state id: %s', $key));
    }
}
