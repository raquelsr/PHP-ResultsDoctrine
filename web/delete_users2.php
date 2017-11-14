<html>
<head>
    <title>Usuarios eliminados</title>
</head>
<body>
<h1 align="center">USUARIOS ELIMINADOS</h1>

</br>
<p align="center">Se han eliminado los usuarios: </p>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

$item = 0;
foreach ($users as $user){

    $valor = $_POST[$item];
    if ($valor == 1 ){
        $entityManager->remove($user);
        echo $user;
    }
    $item++;

}

$entityManager->flush();
?>
</body>
</html>
