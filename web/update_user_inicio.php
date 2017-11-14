<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar usuario</title>
</head>
<body>
<h1 align="center">MODIFICAR USUARIO</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);

$tabla = "<table border=\"1\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Email</td></tr>";

$users = $userRepository->findAll();
foreach ($users as $user) {
    $tabla = $tabla . "<tr><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() . "</td></tr>";
}
echo $tabla;

echo <<<____MARCAFIN
    <form action="update_user_edit.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <table border="0">
                <tr>
                    <td>Editar usuario:</td><td><input type="text" name="username"/>   </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Editar" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
____MARCAFIN;

?>

</body>
</html>