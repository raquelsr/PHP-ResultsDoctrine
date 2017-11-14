<html>
<head>
    <title>Búsqueda usuario</title>
</head>
<body>
<h1 align="center">USUARIO BUSCADO</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);

$username = $_POST['username'];

$tabla = "<table align='center' border=\"8\">";
$tabla = $tabla."<tr><td>Nombre de usuario</td><td>Email</td><td>Activado</td><td>Administrador</td></tr>";

if (empty($username)) {
    $users = $userRepository->findAll();
    foreach ($users as $user){
        $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
        $txtAdmin= $user->isAdmin() ? 'S&iacute;' : 'No';
        $tabla = $tabla."<tr><td>".$user->getUsername()."</td><td>".$user->getEmail().
            "</td><td>". $txtEnabled . "</td><td>" . $txtAdmin . "</td></tr>";
    }

} else {
    $user = $userRepository->findOneBy(array('username' => $username));
    $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
    $txtAdmin= $user->isAdmin() ? 'S&iacute;' : 'No';
    if (empty($user)){
        echo 'No existe el usuario '.$username;
        exit(0);
    }
    $tabla = $tabla."<tr><td>".$user->getUsername()."</td><td>".$user->getEmail().
        "</td><td>". $txtEnabled . "</td><td>" . $txtAdmin . "</td></tr>";
}

echo $tabla;

?>

<a href="list_users.php">Volver a buscar</a></br>
<a href="index.html">Inicio</a>

</body>
</html>