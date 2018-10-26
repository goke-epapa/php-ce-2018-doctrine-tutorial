<?php

namespace Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Value\EmailAddress;

interface Users
{
    public function isRegistered(EmailAddress $emailAddress) : bool;
    public function get(EmailAddress $emailAddress) : User;
    public function store(User $user) : void;
}
