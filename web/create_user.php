<!DOCTYPE html>

<html>
<head>
    <title>Usuario añadido</title>
</head>
<body>

<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

$entityManager = getEntityManager();

$user = new User();
$user->setUsername($_POST['username']);
$user->setEmail($_POST['email']);
$user->setPassword($_POST['password']);
$user->setEnabled(isset($_POST['enabled']) ? true : false);
$user->setIsAdmin(isset($_POST['admin']) ? true : false);

$txtEnabled= isset($_POST['enabled']) ? 'S&iacute;' : 'No';
$txtAdmin= isset($_POST['admin']) ? 'S&iacute;' : 'No';

try {
    $entityManager->persist($user);
    $entityManager->flush();

    echo <<< ___MARCA_FIN
  <table border="1" summary="formulario">
	  <tr>
		  <th colspan="2">Usuario añadido: </th>
		</tr>
	  <tr>
		  <td>Nombre:</td><td>$_POST[username]</td>
		</tr>
	  <tr>
		  <td>Email:</td><td>$_POST[email]</td>
		</tr>
	  <tr>
		  <td>Contraseña:</td><td>$_POST[password]</td>
		</tr>
	  <tr>
		  <td>Activado:</td><td>$txtEnabled</td>
		</tr>
	  <tr>
		  <td>¿Es administrador?</td><td>$txtAdmin</td>
		</tr>
	</table>
___MARCA_FIN;

} catch (Exception $exception) {
    echo <<<____ERROR
        <h2>Ha ocurrido un error.</h2>
____ERROR;
    echo $exception->getMessage();

}
?>
</body>
</html>
