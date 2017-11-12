<!DOCTYPE html>

<html>
<head>
    <title>Actualizar usuario</title>
</head>
<body>

<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

$entityManager = getEntityManager();

$username = $_POST['username'];

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(array('username' => $username));

$valueUsername = $user->getUsername();
$valueEmail = $user->getEmail();
$valueEnabled = $user->isEnabled() ? "checked" : "" ;
$valueAdmin = $user->isAdmin() ? "checked" : "";

echo $valueAdmin;
echo $valueEnabled;

echo <<< ___MARCA_FIN
 <form action="update_user_finish.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Actualizar usuario</legend>
        <table border="0">
            <tr>
                <th colspan="2">Actualizar usuario</th>
            </tr>
            <tr>
                <td>Estas actualizando a: </td><td><input type="text" name="username" readonly="readonly" value=$valueUsername /></td>
            </tr>
            <tr>
                <td>Nombre de usuario:</td><td><input type="text" name="newusername" value=$valueUsername />   </td>
            </tr>
            <tr>
                <td>Email:</td><td><input type="email" name="email" value=$valueEmail/>   </td>
            </tr>
            <tr>
                <td>¿Está activado?</td><td><input type="checkbox" name="enabled" $valueEnabled/>   </td>
            </tr>
            <tr>
                <td>¿Permisos de administrador?</td><td><input type="checkbox" name="admin" $valueAdmin />   </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Aceptar" /></td>
            </tr>
        </table>
    </fieldset>
</form>
___MARCA_FIN;

?>
</body>
</html>
