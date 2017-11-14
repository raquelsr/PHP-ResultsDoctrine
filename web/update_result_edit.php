<!DOCTYPE html>

<html>
<head>
    <title>Modificar resultado</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>
<p align="center"><a href="update_result_inicio.php">Mostrar lista de resultados</a></p>

<h1 align="center">MODIFICAR RESULTADO</h1>
<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

$entityManager = getEntityManager();

$id = $_POST['result'];

$resultRepository = $entityManager->getRepository(Result::class);

$result = $resultRepository->find($id);

$valueResult = $result->getResult();
$valueUser = $result->getUser()->getUsername();

$valueId =substr($id,0,strlen($id) -1);

echo <<< ___MARCA_FIN
 <form action="update_result_finish.php" method="post" enctype="multipart/form-data">
        <table align="center" border="8" bgcolor="#e0ffff">
            <tr>
                <th  bgcolor="#ffebcd" colspan="2" >Modificar resultado</th>
            </tr>
            <tr>
                <td>ID: </td><td><input type="number" name="id" readonly="readonly" value=$valueId /></td>
            </tr>
            <tr>
                <td>Nombre de usuario:</td><td>$valueUser</td>
            </tr>
            <tr>
                <td>Resultado:</td><td><input type="number" name="result" />   </td>
            </tr>
            <tr>
                <td colspan="2" bgcolor="#ffebcd" align="center"><input type="submit" value="Modificar" /></td>
            </tr>
        </table>
</form>
___MARCA_FIN;

?>
</body>
</html>
