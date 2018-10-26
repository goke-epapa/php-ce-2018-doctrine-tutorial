<?php

declare(strict_types=1);

namespace Authentication\Value;

final class ClearTextPassword
{
    private $password;

    private function __construct()
    {
    }

    public static function fromString(string $string): self
    {
        $instance = new self();
        $instance->password = $string;

        return $instance;
    }

    public function makeHash(): PasswordHash
    {
        return PasswordHash::fromString(password_hash($this->password, \PASSWORD_DEFAULT));
    }

    public function verify(PasswordHash $passwordHash): bool
    {
        return password_verify($this->password, $passwordHash->toString());
    }
}
