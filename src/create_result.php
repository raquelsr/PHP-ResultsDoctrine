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
    
    Para insertar resultado debes introducir un resultado y el id del usuario.
    Usage: $fich <Result> <IdUser>

MARCA_FIN;
    exit(0);
}

$newResult    = (int) $argv[1];
$idUser       = (int) $argv[2];
$newTimestamp =  new DateTime('now');

$entityManager = getEntityManager();

/** @var User $user */
$user = $entityManager
    ->getRepository(User::class)
    ->find($idUser);
if (empty($user)) {
    echo "Usuario con ID: $idUser no encontrado." . PHP_EOL;
    exit(0);
}

$result = new Result($newResult, $user, $newTimestamp);
try {
    $entityManager->persist($result);
    $entityManager->flush();
    if (in_array('--json', $argv, true)) {
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        echo 'Añadido resultado ' . $result->getResult() . ' al usuario con ID : ' . $idUser . PHP_EOL;
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}
