<html>
<head>
    <title>Resultados</title>
</head>
<body>
<p align="center">Resultados</p>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
$results = $resultRepository->findAll();

$item = 0;
foreach ($results as $result){

    $valor = $_POST[$item];
    $user = $result->getUser();
    echo $valor;
    if ($valor == 1 ){
        $entityManager->remove($result);
        echo "borrado resultado $result del usuario $user";
    }
    $item++;

}

$entityManager->flush();