<?php   // src/scripts/list_users.html

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

if ($argc > 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich [<IdUser>]

MARCA_FIN;
    exit(0);
}

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);

if (in_array('--json', $argv)) {
    if ($argc ===3){
        $id = (int) $argv[1];
        $users = $userRepository->find($id);
        if (empty($users)){
            echo 'No existe el usuario: ' . $id . PHP_EOL;
            exit(0);
        }
    } else {
        $users = $userRepository->findAll();
    }
        echo json_encode($users, JSON_PRETTY_PRINT).PHP_EOL;


} else if ($argc === 1) {
    $users = $userRepository->findAll();

        $items = 0;
        echo PHP_EOL . sprintf("  %2s: %20s %30s %7s %25s \n", 'Id', 'Username:', 'Email:', 'Enabled:' , 'Last_login');
        /** @var User $user */
        foreach ($users as $user) {
            echo sprintf(
                '- %2d: %20s %30s %7s %25s',
                $user->getId(),
                $user->getUsername(),
                $user->getEmail(),
                ($user->isEnabled()) ? 'true' : 'false',
                $user->getLastLogin()->format("d-m-Y H:i:s")
            ),
            PHP_EOL;
            $items++;
        }

        echo "\nTotal: $items users.\n".PHP_EOL;

} else if ($argc ===2 ){

    $id = (int) $argv[1];
    $user = $userRepository->find($id);

    if (empty($user)){
        echo 'No existe el usuario con ID : ' . $id . "." . PHP_EOL;
    } else {
        echo PHP_EOL . sprintf("  %2s: %20s %30s %7s %25s \n", 'Id', 'Username:', 'Email:', 'Enabled:' , "Last Login");
        echo sprintf(
            '- %2d: %20s %30s %7s %25s',
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
            ($user->isEnabled()) ? 'true' : 'false',
            $user->getLastLogin()->format("d-m-Y H:i:s")
        ),
        PHP_EOL . PHP_EOL;
    }
}

