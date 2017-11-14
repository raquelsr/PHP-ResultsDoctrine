<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resultado modificado</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h1 align="center">RESULTADO MODIFICADO</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);

$id = $_POST['id'];
$result = $resultRepository->find($id);

$result->setResult($_POST['result']);
$result->setTime(new DateTime('now'));
$txtTime = $result->getTime()->format('d-m-Y H:i:s');

$entityManager->flush();

$tabla = "<table align='center' bgcolor=\"#e0ffff\" border=\"8\">";
$tabla = $tabla."<tr bgcolor=\"#ffebcd\"><td>Nombre de usuario</td><td>Resultado</td><td>Fecha</td></tr>";
$tabla = $tabla . "<tr><td>" . $result->getUser()->getUsername() . "</td><td>" . $result->getResult() . "</td><td>" .
                  $txtTime . "</td></tr>";

echo $tabla;

?>

</body>
</html>