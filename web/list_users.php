<html>
<head>
    <title>Usuarios</title>
</head>
<body>
<p align="center">USUARIOS</p>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

$tabla = "<table border=\"1\">";

$tabla = $tabla."<tr><td>Nombre de usuario</td><td>Email</td></tr>";

foreach ($users as $user){
    $tabla = $tabla."<tr><td>".$user->getUsername()."</td><td>".$user->getEmail()."</td></tr>";
}

echo $tabla;

?>
</body>
</html>