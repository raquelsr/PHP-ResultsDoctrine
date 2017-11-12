<html>
<head>
    <title>Resultados</title>
</head>
<body>
<p align="center">RESULTADOS</p>

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

$tabla = "<table border=\"1\">";
$tabla = $tabla."<tr><td>Nombre de usuario</td><td>Resultado</td></tr>";

if (empty($username)){
    $results = $resultRepository->findAll();
} else {
    $user = $userRepository->findOneBy(array('username' => $username));
    if (empty($user)){
        echo 'No existe el usuario '.$username;
        exit(0);
    }
    $results = $resultRepository->findBy(array('user' => $user));
}

foreach ($results as $result){
    $tabla = $tabla."<tr><td>".$result->getUser()->getUsername()."</td><td>".$result->getResult()."</td></tr>";
}
echo $tabla;

?>
</body>
</html>