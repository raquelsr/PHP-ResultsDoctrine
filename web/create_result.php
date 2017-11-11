<!DOCTYPE html>

<html>
<head>
    <title>Resultado añadido</title>
</head>
<body>

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

$user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['username' => $username]);

if (empty($user)) {
    echo "Usuario $username no encontrado." . PHP_EOL;
    exit(0);
}

$result = new Result($newResult, $user, $newTimestamp);
try {
    $entityManager->persist($result);
    $entityManager->flush();

    echo <<< ___MARCA_FIN
  <table border="1" summary="formulario">
	  <tr>
		  <th colspan="2">Usuario añadido: </th>
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
    echo $exception->getMessage();
}

?>
</body>
</html>
