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

    Se puede buscar por nombre de usuario o por resultado depende del valor introducido.
    Usage: $fich [<UserName>] [<Result>]

MARCA_FIN;
    exit(0);
}

$entityManager = getEntityManager();

$resultsRepository = $entityManager->getRepository(Result::class);
$userRepository = $entityManager->getRepository(User::class);

if (in_array('--json', $argv, true)) {
    if ($argc ===3){
        $valor = $argv[1];
        if (is_numeric($valor)==1){
            $results = $resultsRepository->findBy(array('result' => $valor));
        } else {
            $user = $userRepository->findOneBy(array('username' => $valor));
            $results = $resultsRepository->findBy(array('user' => $user));
        }
    } else {
        $results = $resultsRepository->findAll();
    }
    echo json_encode($results, JSON_PRETTY_PRINT).PHP_EOL;

}else if ($argc === 1) {
    /** @var Result[] $results */
    $results = $resultsRepository->findAll();
    echo PHP_EOL . sprintf('%3s - %5s - %20s - %20s', 'Id', 'res', 'username', 'time') . PHP_EOL;
    $items = 0;
    foreach ($results as $result) {
        echo sprintf(
            '- %3s - %5s - %20s - %20s',
            $result->getId(),
            $result->getResult(),
            $result->getUser()->getUsername(),
            $result->getTime()->format("d-m-Y H:i:s")
        ),
            PHP_EOL;
        $items++;
    }
    echo PHP_EOL . "Total: $items results.".PHP_EOL;

} else if ($argc === 2){
    $valor = $argv[1];
    if (is_numeric($valor)==1){
        $results = $resultsRepository->findBy(array('result' => $valor));
    } else {
        $user = $userRepository->findOneBy(array('username' => $valor));
        $results = $resultsRepository->findBy(array('user' => $user));
    }
    echo PHP_EOL . sprintf('%3s - %5s - %20s - %20s', 'Id', 'res', 'username', 'time') . PHP_EOL;
    $items = 0;
    /* @var Result $result */
    foreach ($results as $result) {
        echo sprintf(
            '- %3s - %5s - %20s - %20s',
            $result->getId(),
            $result->getResult(),
            $result->getUser()->getUsername(),
            $result->getTime()->format("d-m-Y H:i:s")
        ),
        PHP_EOL;
        $items++;
    }
    echo PHP_EOL . "Total: $items results.".PHP_EOL;
}
