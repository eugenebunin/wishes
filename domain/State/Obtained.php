<?php
declare(strict_types=1);

namespace Domain\State;

/**
 * Class Obtained
 * @package Domain\State
 */
class Obtained extends State
{
    const SLUG_OBTAINED = 'obtained';

    /**
     * @var array|string[]
     */
    protected array $transitions = [Archived::class, Created::class];

    function canUpdate(): bool
    {
        return true;
    }

    public function slug(): string
    {
        return self::SLUG_OBTAINED;
    }
}
