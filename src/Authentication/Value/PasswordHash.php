<?php

declare(strict_types=1);

namespace Authentication\Value;

final class PasswordHash
{
    /**
     * @var string
     */
    private $value;

    /**
     * PasswordHash constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function verify(Password $password): bool
    {
        return password_verify($password->getValue(), $this->value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

}
