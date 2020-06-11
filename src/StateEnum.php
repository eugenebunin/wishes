<?php
declare(strict_types=1);

namespace App;

use Domain\State\Archived;
use Domain\State\Created;
use Domain\State\Obtained;

final class StateEnum
{
    public static array $values = [
        1 => Created::SLUG_CREATED,
        2 => Obtained::SLUG_OBTAINED,
        3 => Archived::SLUG_ARCHIVED,
    ];

    public static function slug(int $key): string
    {
        if (array_key_exists($key, self::$values) ) {
            return self::$values[$key];
        }
    }

    public static function key(string $slug): int
    {
        if (in_array($slug, self::$values)) {
            return array_search($slug, self::$values);
        }
    }
}
