<?php

namespace Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Repository\Exception\NotFoundException;
use Authentication\Repository\Exception\NotSavedException;

class FileSystemUsersRepository implements Users
{

    public function get(string $emailAddress): User
    {
        $data = @file_get_contents($this->getFileName($emailAddress));

        if($data === false) {
            throw new NotFoundException('Unable to find user with email: ' . $emailAddress);
        }

        return unserialize($data);
    }

    public function store(User $user): void
    {
        $saved = file_put_contents($this->getFileName($user->getEmail()), serialize($user));

        if ($saved === false) {
            throw new NotSavedException('Unable to save user');
        }
    }

    /**
     * @param $email
     *
     * @return string
     */
    private function getFileName($email): string
    {
        return dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'store' . DIRECTORY_SEPARATOR . md5($email);
    }
}
