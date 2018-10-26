<?php

namespace Application;

use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Infrastructure\Authentication\Repository\JsonFileUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$existingUsers = new JsonFileUsers(__DIR__ . '/../data/users.json');

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$emailValueObject = new EmailAddress($email);
$passwordValue = new Password($password);

if (!$existingUsers->isRegistered($emailValueObject)) {
    echo 'Nope';

    return;
}

$user = $existingUsers->get($emailValueObject);

if (!$user->passwordHash->verify($passwordValue)) {
    echo 'Nope';

    return;
}

echo 'OK';
