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
use MiW\Results\Entity\Result;


$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$resultRepository = $entityManager->getRepository(Result::class);
$results = $resultRepository->findAll();

$item = 0;
foreach ($results as $result){
    $newResult = $_POST[$item];

    if ($newResult != $result->getResult()){
        $result->setResult($newResult);
        echo "Modificado $newResult";
    }

    $item++;
}

$entityManager->flush();

?>
</body>
</html>