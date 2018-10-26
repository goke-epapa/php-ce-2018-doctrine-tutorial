<?php

namespace Authentication\Entity;

use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Authentication\Value\PasswordHash;

class User
{
    /** @var EmailAddress */
    public $emailAddress;

    /** @var PasswordHash */
    public $passwordHash;

    /**
     * User constructor.
     *
     * @param EmailAddress $emailAddress
     * @param Password     $password
     */
    public function __construct(EmailAddress $emailAddress, Password $password)
    {
        $this->emailAddress = $emailAddress;
        $this->passwordHash = new PasswordHash(password_hash($password->getValue(), \PASSWORD_DEFAULT));
    }
}
