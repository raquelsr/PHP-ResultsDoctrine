<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
</head>
<body>

<h1 align="center"> LISTA DE USUARIOS</h1>
<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);

$tabla = "<table align='center' border=\"8\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Email</td><td>Activado</td><td>Administrador</td></tr>";

$users = $userRepository->findAll();

foreach ($users as $user) {
    $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
    $txtAdmin= $user->isAdmin() ? 'S&iacute;' : 'No';
    $tabla = $tabla . "<tr><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() .
        "</td><td>". $txtEnabled . "</td><td>" . $txtAdmin . "</td></tr>";
}
echo $tabla . PHP_EOL;

echo <<<____MARCAFIN
    <form action="list_users2.php" method="post" enctype="multipart/form-data">
        <table  align="center" border="0">
            <tr>
                <th colspan="2">Buscar usuario</th>
            </tr>
            <tr>
                <td>Nombre de usuario:</td><td><input type="text" name="username"/>   </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Buscar" /></td>
            </tr>
        </table>
    </form>
____MARCAFIN;

?>

</body>
</html>