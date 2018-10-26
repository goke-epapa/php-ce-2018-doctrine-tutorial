<?php

// registering a new user:

// 1. check if a user with the same email address exists
// 2. if not, create a user
// 3. hash the password
// 4. send the email to confirm activation (we will just display it)
// 5. save the user

// Tip: discuss - email or saving? Chicken-egg problem

require_once __DIR__ . '/../vendor/autoload.php';

use Authentication\Repository\Exception\NotFoundException;
use Authentication\Repository\Exception\NotSavedException;
use Authentication\Repository\FileSystemUsersRepository;
use Authentication\Request\RegisterRequest;
use Authentication\Security\PhpPasswordEncryption;
use Authentication\Transformer\UserRequestTransformer;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Only POST is allowed');
}

$userRequest = new RegisterRequest($_POST['emailAddress'], $_POST['password']);

if (filter_var($userRequest->getEmail(), FILTER_VALIDATE_EMAIL) === false) {
    die('Invalid email');
}

$userFileRepository = new FileSystemUsersRepository();
try {
    $userFileRepository->get($userRequest->getEmail());
    die("User with email {$userRequest->getEmail()} already exists");
} catch (NotFoundException $e) {
    try {
        $userTransformer = new UserRequestTransformer($userRequest, new PhpPasswordEncryption());
        $userFileRepository->store($userTransformer->toEntity());

        echo "Your registration was successful\n";
        echo "A confirmation email has been sent to {$userRequest->getEmail()}";
    } catch (NotSavedException $e) {
        die($e->getMessage());
    }
}
