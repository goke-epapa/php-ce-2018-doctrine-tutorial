<?php

namespace Application;

use Authentication\Value\EmailAddress;
use Authentication\Value\ClearTextPassword;
use Infrastructure\Authentication\Repository\JsonFileUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$existingUsers = new JsonFileUsers(__DIR__ . '/../data/users.json');

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$emailValueObject = EmailAddress::fromString($email);
$passwordValue = ClearTextPassword::fromString($password);

if (!$existingUsers->isRegistered($emailValueObject)) {
    echo 'Nope';

    return;
}

$user = $existingUsers->get($emailValueObject);

if (!$passwordValue->verify($user->passwordHash)) {
    echo 'Nope';

    return;
}

echo 'OK';
