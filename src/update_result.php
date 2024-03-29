<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;

if ($argc <  4 || $argc > 5) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Modifica el resultado de un usuario determinado. 
    Usage: $fich <IdUser> <Result> <NewResult>

MARCA_FIN;
    exit(0);
}

$paramIdUser        = (int)     $argv[1];
$paramResult        = (int)     $argv[2];
$paramNewResult     = (int)     $argv[3];

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($paramIdUser);

if (empty($user)){
    echo "No existe el usuario $paramIdUser".PHP_EOL;
    exit(0);
}

$resultsRepository = $entityManager->getRepository(Result::class);
/** @var Result[] $results */
$results = $resultsRepository->findBy(array('result' => $paramResult, 'user' => $user));

if (empty($results)){
    echo "No existe el resultado $paramResult del usuario con ID: $paramIdUser".PHP_EOL;
    exit(0);
}

foreach ($results as $result) {
    $result->setResult($paramNewResult);
    $result->setTime(new DateTime('now'));
}
$entityManager->flush();

if (in_array('--json', $argv)) {
    echo json_encode($results, JSON_PRETTY_PRINT);
} else {
    echo "Resultados antiguo $paramResult modificado a $paramNewResult para el usuario con ID: $paramIdUser.".PHP_EOL;
}



