<?php

namespace Authentication\Security;

class PhpPasswordEncryption implements PasswordEncryptionInterface
{

    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function validate(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
