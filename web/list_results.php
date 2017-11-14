<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de resultados</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>


<h1 align="center"> LISTA DE RESULTADOS</h1>
<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);

$tabla = "<table align='center' border=\"8\"  bgcolor=\"#ffebcd\">";
$tabla = $tabla . "<tr><td>Resultado</td><td>Nombre de usuario</td><td>Fecha</td></tr>";

$results = $resultRepository->findAll();


echo <<<____MARCAFIN
    <form action="list_results2.php" method="post" enctype="multipart/form-data">
        <table  bgcolor="#48d1cc" align="center" border="0">
            <tr>
                <td>Nombre de usuario:</td><td><input type="text" name="username"/>   </td>
           
                <td colspan="2" align="center"><input type="submit" value="Buscar" /></td>
            </tr>
        </table>
    </form>
</br>
____MARCAFIN;

foreach ($results as $result) {
    $txtTime = $result->getTime()->format('d-m-Y H:i:s');
    $tabla = $tabla . "<tr bgcolor=\"#e0ffff\" ><td>" . $result->getResult() . "</td><td>" . $result->getUser()->getUsername() .
        "</td><td>". $txtTime .  "</td></tr>";
}
echo $tabla . PHP_EOL;

?>

</body>
</html>