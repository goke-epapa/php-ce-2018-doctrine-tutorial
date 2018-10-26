<?php

namespace Authentication\Security;

interface PasswordEncryptionInterface
{
    public function encrypt(string $password) : string;
    public function validate(string $password, string $hash) : bool;
}
