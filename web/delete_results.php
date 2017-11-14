<html>
<head>
    <title>Eliminar resultados</title>
</head>
<body>
<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<h1 align="center">ELIMINAR RESULTADOS</h1>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
$results = $resultRepository->findAll();


$formulario = "<form action=\"delete_results2.php\" method=\"post\" enctype=\"multipart/form-data\">
        <table bgcolor=\"#e0ffff\" align=\"center\" border=\"0\">
            <tr>
                <th bgcolor='#FFFFFF' colspan=\"5\">Selecciona los resultados a eliminar:</th>
            </tr>
            <tr bgcolor='#ffebcd'>
                <td></td>
                <td> Nombre de usuario </td>
                <td> Resultado</td>
                <td> Fecha </td>
             </tr>";

$item = 0;

foreach ($results as $result) {
    $user = $result->getUser()->getUsername();
    $txtFecha = $result->getTime()->format('d-m-Y H:i:s');
    $formulario = $formulario . "<tr><td><input type = \"checkbox\" name =$item value = \"1\" />  
        </td><td>" . $user . "</td><td>" . $result->getResult() . "</td><td>". $txtFecha . "</td></tr>";

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
