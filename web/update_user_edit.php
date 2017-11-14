<!DOCTYPE html>

<html>
<head>
    <title>Modificar usuario</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>
<p align="center"><a href="update_user_inicio.php">Mostrar lista</a></p>

<h1 align="center">MODIFICAR USUARIO</h1>
<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

$entityManager = getEntityManager();

$id = $_POST['user'];

$userRepository = $entityManager->getRepository(User::class);

$user = $userRepository->find($id);

$valueUsername = $user->getUsername();
$valueEmail = $user->getEmail();
$valueEnabled = $user->isEnabled() ? "checked" : "";
$valueToken = $user->getToken();

$valueId =substr($id,0,strlen($id) -1);

echo <<< ___MARCA_FIN
 <form action="update_user_finish.php" method="post" enctype="multipart/form-data">
        <table align="center" border="8" bgcolor="#e0ffff">
            <tr>
                <th  bgcolor="#ffebcd" colspan="2" >Modificar usuario</th>
            </tr>
            <tr>
                <td>ID: </td><td><input type="number" name="id" readonly="readonly" value=$valueId /></td>
            </tr>
            <tr>
                <td>Nombre de usuario:</td><td><input type="text" name="newusername" value=$valueUsername />   </td>
            </tr>
            <tr>
                <td>Email:</td><td><input type="email" name="email" value=$valueEmail/>   </td>
            </tr>
            <tr>
                <td>Contraseña:</td><td><input type="password" name="password" value=$valueEmail/>   </td>
            </tr>
            <tr>
                <td>¿Está activado?</td><td><input type="checkbox" name="enabled" $valueEnabled/>   </td>
            </tr>
            <tr>
                <td>Token:</td><td><input type="text" name="token" value=$valueToken/>   </td>
            </tr>
            <tr>
                <td colspan="2" bgcolor="#ffebcd" align="center"><input type="submit" value="Modificar" /></td>
            </tr>
        </table>
</form>
___MARCA_FIN;

?>
</body>
</html>
