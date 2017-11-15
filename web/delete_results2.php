<html>
<head>
    <title>Resultados eliminados</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h2 align="center">Se han eliminado los siguientes resultados:</h2>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
/* @var Result[] $results */
$results = $resultRepository->findAll();

$tabla = "<table align='center' border=\"8\"  bgcolor=\"#ffebcd\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Resultado</td><td>Fecha</td></tr>";

$item = 0;

foreach ($results as $result){

    $valor = $_POST[$item];
    if ($valor == 1 ){
        $entityManager->remove($result);

        $txtTime = $result->getTime()->format('d-m-Y H:i:s');
        $tabla = $tabla . "<tr bgcolor=\"#e0ffff\"><td>" . $result->getUser()->getUsername() . "</td><td>" . $result->getResult() .
            "</td><td>". $txtTime . "</td></tr>";
    }
    $item++;

}
echo $tabla . PHP_EOL;
$entityManager->flush();
?>
</body>
</html>
