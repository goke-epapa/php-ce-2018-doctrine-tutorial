<?php

declare(strict_types=1);

namespace Authentication\Value;

final class EmailAddress
{
    // state
    private $emailAddress;

    // constructor
    private function __construct()
    {
    }

    public static function fromString(string $string): self
    {
        if (filter_var($string, \FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("Invalid email address");
        }

        $instance = new self();
        $instance->emailAddress = $string;

        return $instance;
    }

    // interactions

    // maybe cast back to primitives
    public function toString(): string
    {
        return $this->emailAddress;
    }
}
