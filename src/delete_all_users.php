<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

if ($argc === 1) {
    $items = 0;

    foreach ($users as $user) {
        $entityManager->remove($user);
        $items++;
    }
    $entityManager->flush();

    echo "Se han borrado todos los usuarios. Total : $items usuarios." . PHP_EOL;

} elseif (in_array('--json', $argv, true)) {
    echo json_encode($users, JSON_PRETTY_PRINT);
}
