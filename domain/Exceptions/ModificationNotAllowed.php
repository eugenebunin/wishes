<?php
declare(strict_types=1);

namespace Domain\Exceptions;

/**
 * Class ModificationNotAllowed
 * @package Domain\Exceptions
 */
class ModificationNotAllowed extends DomainException
{
    /**
     * @var int
     */
    protected $code = Code::MODIFICATION_NOT_ALLOWED;
}
