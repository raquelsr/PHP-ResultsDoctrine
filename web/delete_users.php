<html>
<head>
    <title>Usuarios</title>
</head>
<body>
<p align="center">USUARIOS</p>

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
        <legend>Formulario de Datos personales</legend>
        <table border=\"0\">
            <tr>
                <th colspan=\"2\">Crear formulario</th>
            </tr>";

$item = 0;

foreach ($users as $user) {
    $username = $user->getUsername();
    $formulario = $formulario . "<tr><td><input type = \"checkbox\" name =$item value = \"1\" />  
        </td><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() . "</td></tr>";

    $item++;
}

$formulario = $formulario . "<tr >
                <td colspan = \"2\" align = \"center\" ><input type = \"submit\" value = \"Borrar\" /></td >
            </tr >
        </table >
    </fieldset >
</form >";

echo $formulario;



$tabla = "<table border=\"1\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Email</td></tr>";

foreach ($users as $user) {
    $tabla = $tabla . "<tr><td>" . $user->getUsername() . "</td><td>" . $user->getEmail() . "</td></tr>";
}
echo $tabla;

echo <<<____MARCAFIN
    <form action="delete_users2.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <table border="0">
                <tr>
                    <td>Editar usuario:</td><td><input type="text" name="username"/>   </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Borrar" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
____MARCAFIN;

?>
</body>
</html>