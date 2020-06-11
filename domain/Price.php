<?php
declare(strict_types=1);

namespace Domain;

use Domain\Shared\Value;

/**
 * Class Price
 * @package Domain
 */
class Price implements Value
{
    const DEFAULT_AMOUNT = 0.00;

    protected float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public static function default(): Price
    {
        return new static(static::DEFAULT_AMOUNT);
    }

    public function __toString()
    {
        return $this->value();
    }

    public function value(): string
    {
        return (string)$this->price;
    }
}
