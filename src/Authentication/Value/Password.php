<?php

declare(strict_types=1);

namespace Authentication\Value;

final class Password
{

    private $value;

    /**
     * Password constructor.
     *
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->value = $password;
    }

    /**
     * @return bool|string
     */
    public function getValue()
    {
        return $this->value;
    }
}
