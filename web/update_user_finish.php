<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuario modificado</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h1 align="center">USUARIO MODIFICADO</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);

$id = $_POST['id'];
$user = $userRepository->find($id);

$user->setUsername($_POST['newusername']);
$user->setEmail($_POST['email']);
$user->setEnabled(isset($_POST['enabled']) ? true : false);
$user->setToken($_POST['token']);
$user->setLastLogin(new DateTime('now'));
$txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
$user->setPassword($_POST['password']);
$newEnabled = $user->isEnabled() ? 'S&iacute;' : 'No';
$entityManager->flush();

$tabla = "<table align='center' bgcolor=\"#e0ffff\" border=\"8\">";
$tabla = $tabla."<tr bgcolor=\"#ffebcd\"><td>Nombre de usuario</td><td>Email</td><td>Activado</td><td>Último acceso</td></tr>";
$tabla = $tabla . "<tr><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() . "</td><td>" .
                  $newEnabled . "</td><td>" . $txtLastLogin. "</td></tr>";

echo $tabla;

?>

</body>
</html>