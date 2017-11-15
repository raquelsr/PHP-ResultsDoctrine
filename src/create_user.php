<?php   // src/create_user_admin.php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

if ($argc < 3 || $argc > 5 ) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN
    
    Usage: $fich <UserName> <Email> <PassWord>

MARCA_FIN;
    exit(0);
}

$entityManager = getEntityManager();

$user = new User();
$user->setUsername($argv[1]);
$user->setEmail($argv[2]);
$user->setPassword($argv[3]);
$user->setEnabled(true);
$user->setLastLogin(new \DateTime('now'));

try {
    $entityManager->persist($user);
    $entityManager->flush();
    if (in_array('--json', $argv, true)) {
        echo json_encode($user, JSON_PRETTY_PRINT);
    } else {
        echo 'Usuario ' . $user->getUsername(). ' creado.' . PHP_EOL;
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}
