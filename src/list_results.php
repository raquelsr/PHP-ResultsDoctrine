<?php   // src/list_results.php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;

if ($argc > 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich [<UserName>]

MARCA_FIN;
    exit(0);
}

$entityManager = getEntityManager();

$resultsRepository = $entityManager->getRepository(Result::class);
$userRepository = $entityManager->getRepository(User::class);

if (in_array('--json', $argv, true)) {
    if ($argc ===3){
        $username = $argv[1];
        $user = $userRepository->findOneBy(array('username' => $username));
        $results = $resultsRepository->findBy(array('user' => $user));

    } else {
        $results = $resultsRepository->findAll();
    }
    echo json_encode($results, JSON_PRETTY_PRINT);
}else if ($argc === 1) {
    $results = $resultsRepository->findAll();
    echo PHP_EOL . sprintf('%3s - %5s - %20s - %s', 'Id', 'res', 'username', 'time') . PHP_EOL;
    $items = 0;
    /* @var Result $result */
    foreach ($results as $result) {
        echo $result . PHP_EOL;
        $items++;
    }
    echo PHP_EOL . "Total: $items results.";
} else if ($argc === 2){
    $username = $argv[1];
    $user = $userRepository->findOneBy(array('username' => $username));
    $results = $resultsRepository->findBy(array('user' => $user));

    echo PHP_EOL . sprintf('%3s - %5s - %20s - %s', 'Id', 'res', 'username', 'time') . PHP_EOL;
    $items = 0;
    /* @var Result $result */
    foreach ($results as $result) {
        echo $result . PHP_EOL;
        $items++;
    }
    echo PHP_EOL . "Total: $items results.".PHP_EOL;
}
