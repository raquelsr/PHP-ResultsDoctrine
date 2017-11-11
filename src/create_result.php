<?php   // src/create_result.php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

if ($argc < 3 || $argc > 4) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Result> <UserName> [<Timestamp>]

MARCA_FIN;
    exit(0);
}

$newResult    = (int) $argv[1];
$username      = (string) $argv[2];
$newTimestamp = $argv[3] ?? new DateTime('now');

$entityManager = getEntityManager();

/** @var User $user */
$user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['username' => $username]);
if (empty($user)) {
    echo "Usuario $username no encontrado." . PHP_EOL;
    exit(0);
}

$result = new Result($newResult, $user, $newTimestamp);
try {
    $entityManager->persist($result);
    $entityManager->flush();
    echo 'Añadido resultado ' . $result->getResult() . ' al usuario ' . $user->getUsername() . PHP_EOL;
} catch (Exception $exception) {
    echo $exception->getMessage();
}
