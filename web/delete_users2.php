<html>
<head>
    <title>Usuarios eliminados</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h2 align="center">Se han eliminado los siguientes usuarios:</h2>
<br>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

$tabla = "<table align='center' border=\"8\"  bgcolor=\"#ffebcd\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Email</td><td>Activado</td><td>Último acceso</td></tr>";

foreach ($users as $user){

    $valor = $_POST[$item];
    if ($valor == 1 ){
        $entityManager->remove($user);

        $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
        $txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
        $tabla = $tabla . "<tr bgcolor=\"#e0ffff\"><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() .
         "</td><td>". $txtEnabled . "</td><td>" . $txtLastLogin . "</td></tr>";
    }
    $item++;

}
echo $tabla . PHP_EOL;
$entityManager->flush();
?>
</body>
</html>
