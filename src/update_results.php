<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

if ($argc < 3 || $argc > 4) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich  <Result> <NewResult>

MARCA_FIN;
    exit(0);
}

$paramResult        = (int)     $argv[1];
$paramNewResult     = (int)     $argv[2];

$entityManager = getEntityManager();

$resultsRepository = $entityManager->getRepository(Result::class);
/** @var Result[] $results */
$results = $resultsRepository->findBy(array('result' => $paramResult));

if (empty($results)){
    echo "No existe el resultado $paramResult.".PHP_EOL;
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
    echo "Resultados antiguo $paramResult modificado a $paramNewResult".PHP_EOL;
}



