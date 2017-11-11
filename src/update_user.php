<?php   // src/scripts/list_users.php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

if ($argc != 5) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Username> <NewUserName> <NewEmail> <NewPassword>

MARCA_FIN;
    exit(0);
}

$username   = (string) $argv[1];
$newUsername = (string) $argv[2];
$newEmail = (string) $argv[3];
$newPassword = (string) $argv[4];

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(array('username' => $username));

if (empty($user)) {
    echo "Usuario $username no encontrado." . PHP_EOL;
    exit(0);
}

if (in_array('--json', $argv)) {
    echo json_encode($user, JSON_PRETTY_PRINT);
} else {

    $user->setUsername($newUsername);
    $user->setPassword($newPassword);
    $user->setEmail($newEmail);
    echo PHP_EOL. "Modificado usuario : $username a :".PHP_EOL;
    echo PHP_EOL . sprintf("  %2s: %20s %30s %7s\n", 'Id', 'Username:', 'Email:', 'Enabled:');
    echo sprintf(
        '- %2d: %20s %30s %7s',
        $user->getId(),
        $user->getUsername(),
        $user->getEmail(),
        ($user->isEnabled()) ? 'true' : 'false'
    ),
    PHP_EOL;

    $entityManager->flush();
}

