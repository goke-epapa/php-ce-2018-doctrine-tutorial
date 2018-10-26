<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Repository\Users;
use Authentication\Value\EmailAddress;
use Authentication\Value\PasswordHash;

final class JsonFileUsers implements Users
{
    /** @var string */
    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * @param string $emailAddress
     *
     * @return bool
     */
    public function isRegistered(EmailAddress $emailAddress): bool
    {
        return isset($this->existingUsers()[$emailAddress->getValue()]);
    }

    public function get(EmailAddress $emailAddress): User
    {
        $passwordHash = $this->existingUsers()[$emailAddress->getValue()] ?? null;

        if (null === $passwordHash) {
            throw new \Exception(sprintf('User %s does not exist', $emailAddress));
        }

        $user = (new \ReflectionClass(User::class))
            ->newInstanceWithoutConstructor();

        $user->emailAddress = $emailAddress;
        $user->passwordHash = new PasswordHash($passwordHash);

        return $user;
    }

    public function store(User $user): void
    {
        $users = $this->existingUsers();

        $users[$user->emailAddress->getValue()] = $user->passwordHash->getValue();

        file_put_contents($this->file, json_encode($users));
    }

    private function existingUsers(): array
    {
        return json_decode(file_get_contents($this->file), true);
    }
}
