<?php
declare(strict_types=1);

namespace Domain\State;

/**
 * Class Archived
 * @package Domain\State
 */
class Archived extends State
{
    const SLUG_ARCHIVED = 'archived';

    /**
     * @var array|string[]
     */
    protected array $transitions = [];

    function canUpdate(): bool
    {
        return false;
    }

    public function slug(): string
    {
        return self::SLUG_ARCHIVED;
    }
}
