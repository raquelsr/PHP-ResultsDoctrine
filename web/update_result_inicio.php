<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar resultado</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h1 align="center">MODIFICAR RESULTADOS</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;


$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$resultRepository = $entityManager->getRepository(Result::class);

$results = $resultRepository->findAll();


$formulario = "<form action=\"update_result_edit.php\" method=\"post\" enctype=\"multipart/form-data\">
        <table align='center' border='2'  bgcolor=\"#e0ffff\" >
            <tr>
                <th bgcolor=\"#FFFFFF\" colspan=\"5\">Selecciona el resultado a modificar:</th>
            </tr>
            <tr bgcolor='#ffdab9'>
                <td> </td>
                <td> Nombre de usuario </td>
                <td> Resultado</td>
                <td> Fecha </td>
             </tr>";


foreach ($results as $result) {
    $id = $result->getId();
    $txtTime = $result->getTime()->format('d-m-Y H:i:s');

    $formulario = $formulario . "<tr  bgcolor=\"#e0ffff\"><td><input type = \"radio\" name =\"result\" value = $id/>" .
        "</td><td>" . $result->getUser()->getUsername() . "</td><td>" . $result->getResult() .
        "</td><td>". $txtTime .  "</td></tr>";

}

$formulario = $formulario . "<tr >
                <td colspan = \"5\" bgcolor='#ffdab9' align = \"center\" ><input type = \"submit\" value = \"Modificar\" /></td >
            </tr >
        </table >
</form >";

echo $formulario;
?>


</body>
</html>