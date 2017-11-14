<html>
<head>
    <title>Modificar usuarios</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h1 align="center">MODIFICAR USUARIOS</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();


$formulario = "<form action=\"update_user_edit.php\" method=\"post\" enctype=\"multipart/form-data\">
        <table align='center' border='2'  bgcolor=\"#e0ffff\" >
            <tr>
                <th bgcolor=\"#FFFFFF\" colspan=\"5\">Selecciona el usuario a modificar:</th>
            </tr>
            <tr bgcolor='#ffdab9'>
                <td></td>
                <td> Nombre de usuario </td>
                <td> Email</td>
                <td> Activado </td>
                <td> Último acceso</td>
             </tr>";

foreach ($users as $user) {
    $username = $user->getUsername();
    $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
    $id = $user->getId();
    $txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
    $formulario = $formulario . "<tr><td><input type = \"radio\" name =\"user\" value = $id/>  
        </td><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() .
        "</td><td>". $txtEnabled . "</td><td>" . $txtLastLogin . "</td></tr>";

}

$formulario = $formulario . "<tr >
                <td colspan = \"5\" bgcolor='#ffdab9' align = \"center\" ><input type = \"submit\" value = \"Modificar\" /></td >
            </tr >
        </table >
</form >";

echo $formulario;


?>
</body>
</html>