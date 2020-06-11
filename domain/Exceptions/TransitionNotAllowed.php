<?php
declare(strict_types=1);

namespace Domain\Exceptions;

/**
 * Class TransitionNotAllowed
 * @package Domain\Exceptions
 */
class TransitionNotAllowed extends DomainException
{
    /**
     * @var int
     */
    protected $code = Code::TRANSITION_NOT_ALLOWED;
}
