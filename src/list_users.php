<?php   // src/scripts/list_users.php

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

if ($argc > 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich [<UserName>]

MARCA_FIN;
    exit(0);
}

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);

if (in_array('--json', $argv)) {
    if ($argc ===3){
        $username = $argv[1];
        $users = $userRepository->findOneBy(array('username' => $username));
        if (empty($users)){
            echo 'No existe el usuario: ' . $username . PHP_EOL;
        }
    } else {
        $users = $userRepository->findAll();
    }
        echo json_encode($users, JSON_PRETTY_PRINT).PHP_EOL;


} else if ($argc === 1) {
    $users = $userRepository->findAll();

        $items = 0;
        echo PHP_EOL . sprintf("  %2s: %20s %30s %7s\n", 'Id', 'Username:', 'Email:', 'Enabled:');
        /** @var User $user */
        foreach ($users as $user) {
            echo sprintf(
                '- %2d: %20s %30s %7s',
                $user->getId(),
                $user->getUsername(),
                $user->getEmail(),
                ($user->isEnabled()) ? 'true' : 'false'
            ),
            PHP_EOL;
            $items++;
        }

        echo "\nTotal: $items users.\n".PHP_EOL;

} else if ($argc ===2 ){

    $username = $argv[1];
    $user = $userRepository->findOneBy(array('username' => $username));

    if (empty($user)){
        echo 'No existe el usuario: ' . $username . "." . PHP_EOL;
    } else {
        echo PHP_EOL . sprintf("  %2s: %20s %30s %7s\n", 'Id', 'Username:', 'Email:', 'Enabled:');
        echo sprintf(
            '- %2d: %20s %30s %7s',
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
            ($user->isEnabled()) ? 'true' : 'false'
        ),
        PHP_EOL . PHP_EOL;
    }
}

