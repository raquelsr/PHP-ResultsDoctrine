<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>


<h1 align="center"> LISTA DE USUARIOS</h1>
<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);

$tabla = "<table align='center' border=\"8\"  bgcolor=\"#ffebcd\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Email</td><td>Activado</td><td>Último acceso</td></tr>";

$users = $userRepository->findAll();


echo <<<____MARCAFIN
    <form action="list_users2.php" method="post" enctype="multipart/form-data">
        <table  bgcolor="#48d1cc" align="center" border="0">
            <tr>
                <td>Nombre de usuario:</td><td><input type="text" name="username"/>   </td>
           
                <td colspan="2" align="center"><input type="submit" value="Buscar" /></td>
            </tr>
        </table>
    </form>
</br>
____MARCAFIN;

foreach ($users as $user) {
    $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
    $txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
    $tabla = $tabla . "<tr bgcolor=\"#e0ffff\" ><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() .
        "</td><td>". $txtEnabled . "</td><td>" . $txtLastLogin . "</td></tr>";
}
echo $tabla . PHP_EOL;

?>

</body>
</html>