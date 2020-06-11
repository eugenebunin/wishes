<?php
declare(strict_types=1);

namespace Domain\Exceptions;

use Exception;

/**
 * Class DomainException
 * @package Domain\Exceptions
 */
class DomainException extends Exception
{
    /**
     * @var int
     */
    protected $code = Code::DOMAIN_ERROR;
}
