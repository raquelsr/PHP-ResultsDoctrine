<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;

if ($argc < 3 || $argc > 4) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <IdUser> <Result> 

MARCA_FIN;
    exit(0);
}

$id = (string)$argv[1];
$paramResult = (int)$argv[2];


$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($id);

if (empty($user)) {
    echo "No existe el usuario $id" . PHP_EOL;
    exit(0);
}

$resultsRepository = $entityManager->getRepository(Result::class);
$results = $resultsRepository->findBy(array('result' => $paramResult, 'user' => $user));

if (empty($results)) {
    echo "No existe el resultado $paramResult del usuario $id" . PHP_EOL;
    exit(0);
}


foreach ($results as $result) {
    $entityManager->remove($result);

    if (in_array('--json', $argv, true)) {
        echo 'Borrado resultado:'.PHP_EOL;
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        echo 'Borrado resultado ' . $paramResult . " del usuario $id." . PHP_EOL;
    }
}

$entityManager->flush();





