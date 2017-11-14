<html>
<head>
    <title>Búsqueda resultados de usuario</title>
</head>
<body>

<a href="list_users.php">Nueva búsqueda</a><br>
<a href="index.html">Volver a página de inicio</a>

<h1 align="center">RESULTADOS DEL USUARIO</h1>


<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;


$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
$userRepository = $entityManager->getRepository(User::class);

$username = $_POST['username'];

$tabla = "<table align='center' bgcolor=\"#e0ffff\" border=\"8\">";
$tabla = $tabla . "<tr bgcolor=\"#ffebcd\"><td>Resultado</td><td>Nombre de usuario</td><td>Fecha</td></tr>";

if (empty($username)) {
    $results = $resultRepository->findAll();
    foreach ($results as $result){
        $txtTime = $result->getTime()->format('d-m-Y H:i:s');
        $tabla = $tabla . "<tr bgcolor=\"#e0ffff\" ><td>" . $result->getResult() . "</td><td>" . $user->getUsername() .
            "</td><td>". $txtTime .  "</td></tr>";
    }

} else {
    $users = $userRepository->findBy(array('username' => $username));
    if (empty($users)){
        echo 'No existe el usuario '.$username;
        exit(0);
    } else {
        foreach($users as $user){
            $results = $resultRepository->findBy(array('user' => $user));
            foreach ($results as $result){
                $txtTime = $result->getTime()->format('d-m-Y H:i:s');
                $tabla = $tabla . "<tr bgcolor=\"#e0ffff\" ><td>" . $result->getResult() . "</td><td>" . $user->getUsername() .
                    "</td><td>". $txtTime .  "</td></tr>";
            }
        }
    }
}

echo $tabla;

?>

</body>
</html>