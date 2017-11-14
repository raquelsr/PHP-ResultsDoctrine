<html>
<head>
    <title>Eliminar usuarios</title>
</head>
<body>
<h1 align="center">ELIMINAR USUARIOS</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();


$formulario = "<form action=\"delete_users2.php\" method=\"post\" enctype=\"multipart/form-data\">
 <fieldset>
        <legend>Lista de usuarios</legend>
        <table border=\"0\">
            <tr>
                <th colspan=\"5\">Selecciona los usuarios a eliminar:</th>
            </tr>
            <tr bgcolor='#ffdab9'>
                <td></td>
                <td> Nombre de usuario </td>
                <td> Email</td>
                <td> Activado </td>
                <td> Administrador</td>
             </tr>";

$item = 0;

foreach ($users as $user) {
    $username = $user->getUsername();
    $txtEnabled= $user->isEnabled() ? 'S&iacute;' : 'No';
    $txtAdmin= $user->isAdmin() ? 'S&iacute;' : 'No';
    $formulario = $formulario . "<tr><td><input type = \"checkbox\" name =$item value = \"1\" />  
        </td><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() .
        "</td><td>". $txtEnabled . "</td><td>" . $txtAdmin . "</td></tr>";

    $item++;
}

$formulario = $formulario . "<tr >
                <td colspan = \"5\" bgcolor='#008b8b' align = \"center\" ><input type = \"submit\" value = \"Eliminar\" /></td >
            </tr >
        </table >
    </fieldset >
</form >";

echo $formulario;


?>
</body>
</html>