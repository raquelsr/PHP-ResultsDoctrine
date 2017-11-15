<?php // src/scripts/list_users.html

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

if ($argc < 2 || $argc > 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Id>

MARCA_FIN;
    exit(0);
}

$id = (int)$argv[1];

$entityManager = getEntityManager();

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($id);

if (empty($user)) {
    echo "Usuario con ID $id no encontrado." . PHP_EOL;
    exit(0);
}

$entityManager->remove($user);
$entityManager->flush();

if (in_array('--json', $argv, true)) {
    echo 'Borrado usuario: ' . PHP_EOL;
    echo json_encode($user, JSON_PRETTY_PRINT);
} else {
    echo 'Borrado usuario con ID ' . $id . PHP_EOL;
}

