<?php
declare(strict_types=1);

namespace Domain\State;

/**
 * Class Created
 * @package Domain\State
 */
class Created extends State
{
    const SLUG_CREATED = 'created';

    protected array $transitions = [Obtained::class, Archived::class];

    function canUpdate(): bool
    {
        return true;
    }

    public function slug(): string
    {
        return self::SLUG_CREATED;
    }
}
