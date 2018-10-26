<?php

declare(strict_types=1);

namespace Authentication\Value;

final class EmailAddress
{
    // state
    private $emailAddress;

    // constructor
    /**
     * EmailAddress constructor.
     *
     * @param $emailAddress
     *
     * @throws \Exception
     */
    public function __construct(string $emailAddress)
    {
        if(filter_var($emailAddress, \FILTER_VALIDATE_EMAIL) === false) {
            throw new \Exception("Invalid email address");
        }
        $this->emailAddress = $emailAddress;
    }

    // interactions

    // maybe cast back to primitives
    public function getValue() : string
    {
        return $this->emailAddress;
    }
}
