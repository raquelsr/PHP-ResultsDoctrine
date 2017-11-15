<html>
<head>
    <title>Eliminar usuarios</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h1 align="center">ELIMINAR USUARIOS</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
/** @var User[] $users */
$users = $userRepository->findAll();


$formulario = "<form action=\"delete_users2.php\" method=\"post\" enctype=\"multipart/form-data\">
        <table bgcolor=\"#e0ffff\" align=\"center\" border=\"4\">
            <tr>
                <th bgcolor='#FFFFFF' colspan=\"5\">Selecciona los usuarios a eliminar:</th>
            </tr>
            <tr bgcolor='#ffebcd'>
                <td></td>
                <td> Nombre de usuario </td>
                <td> Email</td>
                <td> Activado </td>
                <td> Último acceso</td>
             </tr>";

$item = 0;

foreach ($users as $user) {
    $username = $user->getUsername();
    $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
    $txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
    $formulario = $formulario . "<tr><td><input type = \"checkbox\" name =$item value = \"1\" />  
        </td><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() .
        "</td><td>". $txtEnabled . "</td><td>" . $txtLastLogin . "</td></tr>";

    $item++;
}

$formulario = $formulario . "<tr >
                <td colspan = \"5\" bgcolor='#ffebcd' align = \"center\" ><input type = \"submit\" value = \"Eliminar\" /></td >
            </tr >
        </table >
</form >";

echo $formulario;


?>
</body>
</html>