<?php

namespace Authentication\Entity;

use Authentication\Value\EmailAddress;
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
     * @param PasswordHash $passwordHash
     */
    public function __construct(EmailAddress $emailAddress, PasswordHash $passwordHash)
    {
        $this->emailAddress = $emailAddress;
        $this->passwordHash = $passwordHash;
    }
}
