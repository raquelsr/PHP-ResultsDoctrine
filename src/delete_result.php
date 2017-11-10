<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

if ($argc !=  3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Result> <UserId> 

MARCA_FIN;
    exit(0);
}

$paramResult    = (int) $argv[1];
$paramUserId    = (int) $argv[2];

$entityManager = getEntityManager();

$resultsRepository = $entityManager->getRepository(Result::class);
$results = $resultsRepository->findBy(array('result' => $paramResult));

if (empty($results)){
    echo 'No hay na'.PHP_EOL;
    exit(0);
}

if (in_array('--json', $argv)) {
    echo json_encode($results, JSON_PRETTY_PRINT);
} else {

    foreach ($results as $result) {
        $entityManager->remove($result);
        echo PHP_EOL . "Borrado resultado $result".PHP_EOL;
    }
    $entityManager->flush();
}



