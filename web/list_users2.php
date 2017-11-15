<html>
<head>
    <title>Búsqueda usuario</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>
<p align="center"><a href="list_users.php">Nueva búsqueda</a></p>


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

$tabla = "<table align='center' bgcolor=\"#e0ffff\" border=\"4\">";
$tabla = $tabla."<tr bgcolor=\"#ffebcd\"><td>Nombre de usuario</td><td>Email</td><td>Activado</td><td>Último acceso</td></tr>";

if (empty($username)) {
    /* @var User[] $users */
    $users = $userRepository->findAll();
    foreach ($users as $user){
        $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
        $txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
        $tabla = $tabla."<tr><td>".$user->getUsername()."</td><td>".$user->getEmail().
            "</td><td>". $txtEnabled . "</td><td>" . $txtLastLogin . "</td></tr>";
    }

} else {
    /* @var User[] $users */
    $users = $userRepository->findBy(array('username' => $username));
    if (empty($users)){
        echo 'No existe el usuario '.$username;
        exit(0);
    } else {
        foreach($users as $user){
            $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
            $txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
            $tabla = $tabla."<tr><td>".$user->getUsername()."</td><td>".$user->getEmail().
                "</td><td>". $txtEnabled . "</td><td>" . $txtLastLogin . "</td></tr>";
        }
    }
}

echo $tabla;

?>

</body>
</html>