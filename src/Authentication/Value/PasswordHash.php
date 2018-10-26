<?php

declare(strict_types=1);

namespace Authentication\Value;

final class PasswordHash
{
    /**
     * @var string
     */
    private $hash;

    public function __construct()
    {
    }

    public static function fromString(string $string): self
    {
        $instance = new self();
        $instance->hash = $string;

        return $instance;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->hash;
    }

}
