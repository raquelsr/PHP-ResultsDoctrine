<?php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

if ($argc < 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <NewEnabled> <UserName>

MARCA_FIN;
    exit(0);
}

$newEnabled     = (int)    $argv[1];

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);

for($i=2; $i<$argc; $i++){

    $username = $argv[$i];
    $user = $userRepository->findOneBy(array('username' => $username));

    if (empty($user)) {
        echo "Usuario $username no encontrado." . PHP_EOL;
    } else {
        $user->setEnabled($newEnabled);
        $user->setLastLogin(new \DateTime('now'));

        if (in_array('--json', $argv)) {
            echo PHP_EOL. 'Modificado usuario: ' . $username .PHP_EOL;
            echo json_encode($user, JSON_PRETTY_PRINT);
        } else {
            echo PHP_EOL. "Modificado usuario: $username a :".PHP_EOL;
            echo PHP_EOL . sprintf("  %2s: %20s %7s %25s\n", 'Id', 'Username:', 'Enabled:', 'Last Login');
            echo sprintf(
                '- %2d: %20s %7s %25s',
                $user->getId(),
                $user->getUsername(),
                ($user->isEnabled()) ? 'true' : 'false',
                $user->getLastLogin()->format("d-m-Y H:i:s")
            ),
            PHP_EOL;
        }
    }
}

$entityManager->flush();


