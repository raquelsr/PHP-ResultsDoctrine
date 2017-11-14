<!DOCTYPE html>

<html>
<head>
    <title>Resultado añadido</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>
<p align="center"><a href="html/create_result.html">Añadir nuevo resultado</a></p>



<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;

$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

$entityManager = getEntityManager();

$username = $_POST['username'];
$newResult = $_POST['result'];
$newTimestamp = new DateTime('now');

$users = $entityManager
    ->getRepository(User::class)
    ->findBy(['username' => $username]);

if (empty($users)) {
    echo "Usuario $username no encontrado." . PHP_EOL;
    exit(0);
}

foreach ($users as $user){
    $result = new Result($newResult, $user, $newTimestamp);
    try {
        $entityManager->persist($result);
        $entityManager->flush();

        echo <<< ___MARCA_FIN
                <h2 align="center">El resultado ha sido añadido correctamente:</h2>

  <table  align="center" border="8" bgcolor="#e0ffff"  summary="formulario">
	  <tr>
		  <th bgcolor="#ffebcd" colspan="2">Resultado </th>
		</tr>
	  <tr>
		  <td>Nombre de usuario:</td><td>$_POST[username]</td>
		</tr>
	  <tr>
		  <td>Resultado:</td><td>$_POST[result]</td>
		</tr>
	</table>
___MARCA_FIN;

    } catch (Exception $exception) {
        echo <<<____ERROR
        <h2 align="center">Ha ocurrido un error.</h2>
____ERROR;
        echo $exception->getMessage();
    }
}


?>
</body>
</html>
