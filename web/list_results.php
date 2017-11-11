<html>
<head>
    <title>Resultados</title>
</head>
<body>
<p align="center">RESULTADOS</p>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();

$resultRepository = $entityManager->getRepository(Result::class);
$results = $resultRepository->findAll();

$tabla = "<table border=\"1\">";

$tabla = $tabla."<tr><td>Nombre de usuario</td><td>Resultado</td></tr>";

foreach ($results as $result){
    $tabla = $tabla."<tr><td>".$result->getUser()->getUsername()."</td><td>".$result->getResult()."</td></tr>";
}

echo $tabla;

?>
</body>
</html>