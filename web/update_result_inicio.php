<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar usuario</title>
</head>
<body>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;


$entityManager = getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$resultRepository = $entityManager->getRepository(Result::class);

$tabla = "<table border=\"1\">";
$tabla = $tabla . "<tr><td>Nombre de usuario</td><td>Resultado</td></tr>";

$results = $resultRepository->findAll();
foreach ($results as $result) {
    $user = $result->getUser();
    $tabla = $tabla . "<tr><td>" . $user . "</td><td>" . $result->getResult() . "</td></tr>";
}
echo $tabla;

$form = "<form action=\"update_result_edit.php\" method=\"post\" enctype=\"multipart/form-data\">
    <fieldset>
        <table border=\"0\">
            <tr>
                <th colspan=\"2\">Crear formulario</th>
            </tr>";

$item = 0;

foreach ($results as $result) {

    $num =  (integer) $result->getResult();
    $num2 = (string) $num;
    echo 'num' . $num2;

    $user = $result->getUser();



    $form = $form . " <tr>
                    <td>Editar resultado:</td><td><input type=\"text\" name=$item value = $num/>   </td>
                </tr";

    $item++;
}

$form = $form . "<tr>
                    <td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Editar\" /></td>
                </tr>
            </table>
        </fieldset>
    </form>";

echo $form;
?>



</body>
</html>