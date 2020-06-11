<?php

namespace Domain\State;

/**
 * Class State
 * @package Domain\State
 */
abstract class State
{
    /**
     * @var array|string[]
     */
    protected array $transitions = [];

    abstract function canUpdate(): bool;

    public function canMoveTo(State $state): bool
    {
        if (in_array(get_class($state), $this->transitions)) {
            return true;
        }
        return false;
    }

    abstract public function slug(): string;
}
