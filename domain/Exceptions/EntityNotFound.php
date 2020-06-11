<?php
declare(strict_types=1);

namespace Domain\Exceptions;

/**
 * Class EntityNotFound
 * @package Domain\Exceptions
 */
class EntityNotFound extends DomainException
{
    /**
     * @var int
     */
    protected $code = Code::ENTITY_NOT_FOUND;
}
