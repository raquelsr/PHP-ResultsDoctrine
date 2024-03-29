<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();

$resultsRepository = $entityManager->getRepository(Result::class);
$results = $resultsRepository->findAll();


$items = 0;

foreach ($results as $result) {
    $entityManager->remove($result);
    $items++;
}
$entityManager->flush();

if (in_array('--json', $argv, true)) {
    echo json_encode($results, JSON_PRETTY_PRINT);
} else {
    echo 'Se han borrado todos los resultados. Total : ' . $items . ' resultados borrados.' . PHP_EOL;
}



