<?php

namespace Domain\Shared;

use Stringable;

/**
 * Interface Value
 * @package Domain\Shared
 */
interface Value extends Stringable
{
    public function value(): string;
}
