<?php
declare(strict_types=1);

namespace Domain;

use Domain\Exceptions\InvalidFormat;
use Domain\Shared\Value;

/**
 * Class Title
 * @package Domain
 */
class Title implements Value
{
    const MAX_LENGTH = 256;
    const MIN_LENGTH = 2;

    protected string $title;

    /**
     * Title constructor.
     * @param string $title
     * @throws InvalidFormat
     */
    public function __construct(string $title)
    {
        $this->validate($title);
        $this->title = $title;
    }

    /**
     * @param string $title
     * @throws InvalidFormat
     */
    protected function validate(string $title)
    {
        if (strlen($title) > self::MAX_LENGTH || strlen($title) < self::MIN_LENGTH) {
            throw new InvalidFormat('invalid title length');
        }
    }

    public function value(): string
    {
        return $this->title;
    }

    public function __toString()
    {
        return $this->value();
    }
}
