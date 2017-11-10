<?php   // src/scripts/list_users.php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

if ($argc != 2) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Username>

MARCA_FIN;
    exit(0);
}

$username   = (string) $argv[1];

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findBy(array('username' => $username));

if (empty($users)) {
    echo "Usuario $username no encontrado." . PHP_EOL;
    exit(0);
}

if (in_array('--json', $argv)) {
    echo json_encode($users, JSON_PRETTY_PRINT);
} else {

    foreach ($users as $user) {
        $entityManager->remove($user);
        echo PHP_EOL . "Borrado usuario $user".PHP_EOL;
    }
    $entityManager->flush();
}

