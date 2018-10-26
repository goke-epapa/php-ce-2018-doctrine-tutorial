<?php

namespace Authentication\Transformer;

use Authentication\Entity\User;
use Authentication\Request\RegisterRequest;
use Authentication\Security\PasswordEncryptionInterface;

class UserRequestTransformer implements TransformerInterface
{
    /**
     * @var RegisterRequest
     */
    private $registerRequest;

    /**
     * @var PasswordEncryptionInterface
     */
    private $passwordEncryptor;

    /**
     * UserRequestTransformer constructor.
     *
     * @param RegisterRequest             $userRequest
     * @param PasswordEncryptionInterface $passwordEncryptor
     */
    public function __construct(RegisterRequest $userRequest, PasswordEncryptionInterface $passwordEncryptor)
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
