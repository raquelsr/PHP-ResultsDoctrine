<html>
<head>
    <title>Resultados</title>
</head>
<body>
<p align="center">Resultados</p>

<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\Result;

$entityManager = getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
$results = $resultRepository->findAll();


$item = 0;

echo <<<____MARCAINICIO
    <form action=delete_results2.php method="post" enctype="multipart/form-data">
    <fieldset>
    <legend>Formulario de Datos personales</legend>
        <table border=\"0\">
            <tr>
                <td>Seleccionar</td><td>Resultado</td><td>Usuario</td>
            </tr>
____MARCAINICIO;


foreach ($results as $result) {

    $user = $result -> getUser();
    $r = $result->getResult();

    echo <<<____MARCAFORM
            <tr>
                <td>
                    <input type = "checkbox" name =$item value = "1" />  
                </td>
                <td>  $r </td>
                <td>  $user </td>
            </tr>
____MARCAFORM;


    $item++;
}

echo <<<____MARCAFIN
<tr >
                <td colspan = "2" align = "center" ><input type = "submit" value = "Borrar" /></td >
            </tr >
        </table >
    </fieldset >
</form >
____MARCAFIN;

?>
</body>
</html>
