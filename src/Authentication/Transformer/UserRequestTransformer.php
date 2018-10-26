<?php

namespace Authentication\Transformer;

use Authentication\Entity\User;
use Authentication\Request\RegisterRequest;
use Authentication\Security\PasswordEncryptor;

class UserRequestTransformer implements Transformer
{
    /**
     * @var RegisterRequest
     */
    private $registerRequest;

    /**
     * @var PasswordEncryptor
     */
    private $passwordEncryptor;

    /**
     * UserRequestTransformer constructor.
     *
     * @param RegisterRequest   $userRequest
     * @param PasswordEncryptor $passwordEncryptor
     */
    public function __construct(RegisterRequest $userRequest, PasswordEncryptor $passwordEncryptor)
    {
        $this->registerRequest = $userRequest;
        $this->passwordEncryptor = $passwordEncryptor;
    }

    public function toEntity(): User
    {
        $user = new User();
        $user->setEmail($this->registerRequest->getEmail());
        $user->setPassword($this->passwordEncryptor->encrypt($this->registerRequest->getPassword()));


        return $user;
    }
}
