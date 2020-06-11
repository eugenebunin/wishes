<?php
declare(strict_types=1);

namespace Domain\Exceptions;

/**
 * Class InvalidFormat
 * @package Domain\Exceptions
 */
class InvalidFormat extends DomainException
{
    /**
     * @var int
     */
    protected $code = Code::INVALID_FORMAT;
}
