<?php
declare(strict_types=1);

namespace Domain\Exceptions;

/**
 * Class Code
 * @package Domain\Exceptions
 */
class Code
{
    const DOMAIN_ERROR = 1000;

    const MODIFICATION_NOT_ALLOWED = 2000;
    const TRANSITION_NOT_ALLOWED = 2001;

    const INVALID_FORMAT = 3000;

    const ENTITY_NOT_FOUND = 4000;
}
