<?php

namespace Application;

use Authentication\Entity\User;
use Authentication\Value\EmailAddress;
use Authentication\Value\ClearTextPassword;
use Infrastructure\Authentication\Repository\JsonFileUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$existingUsers = new JsonFileUsers(__DIR__ . '/../data/users.json');
$email = $_POST['emailAddress'];
$password = $_POST['password'];

$emailAddressValue = EmailAddress::fromString($email);
$passwordValue = ClearTextPassword::fromString($password);

if ($existingUsers->isRegistered($emailAddressValue)) {
    echo 'Already registered';

    return;
}

$existingUsers->store(new User($emailAddressValue, $passwordValue->makeHash()));

// Maybe notification system? Later...
error_log(sprintf('User %s registered', $email));

echo 'Registered';

