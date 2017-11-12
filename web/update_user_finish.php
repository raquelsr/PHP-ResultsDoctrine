<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuario actualizado</title>
</head>
<body>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);

$username = $_POST['username'];
$user = $userRepository->findOneBy(array('username' => $username));

echo $user;

$oldUsername = $user->getUsername();
$oldEmail = $user->getEmail();
$oldEnabled = $user->isEnabled() ? 'S&iacute;' : 'No';
$oldAdmin = $user->isAdmin() ? 'S&iacute;' : 'No';

$user->setUsername($_POST['newusername']);
$user->setEmail($_POST['email']);
$user->setEnabled(isset($_POST['enabled']) ? true : false);
$user->setIsAdmin(isset($_POST['admin']) ? true : false);

$entityManager->flush();

$tabla = "<table border=\"1\">";
$tabla = $tabla . "<tr>Antiguo usuario</tr>";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Email</td></tr>";
$tabla = $tabla . "<tr><td>$oldUsername</td><td>$oldEmail</td></tr>";
$tabla = $tabla . "<tr>Nuevo usuario</tr>";
$tabla = $tabla . "<tr><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() . "</td></tr>";

echo $tabla;

?>

<a href="update_user_inicio.php">Volver</a>
</body>
</html>