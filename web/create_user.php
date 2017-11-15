<!DOCTYPE html>

<html>
<head>
    <title>Usuario añadido</title>
</head>
<body>

<p align="center"><a href="index.html">Volver a página de inicio</a></p>

<p align="center"><a href="html/create_user.html">Crear otro usuario</a></p>

<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use MiW\Results\Entity\User;

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(__DIR__ . '/..', \MiW\Results\Utils::getEnvFileName(__DIR__ . '/..'));
$dotenv->load();

$entityManager = getEntityManager();

$user = new User();
$user->setUsername($_POST['username']);
$user->setEmail($_POST['email']);
$user->setPassword($_POST['password']);

$txtEnabled = $user->isEnabled() ? 'S&iacute;' : 'No';
$txtLastLogin = $user->getLastLogin()->format('d-m-Y H:i:s');
$txtToken = $user->getToken();


try {
    $entityManager->persist($user);
    $entityManager->flush();

    echo <<< ___MARCA_FIN
        <h2 align="center">El usuario "$_POST[username]" ha sido añadido correctamente.</h2>
      <table align="center" border="8" bgcolor="#e0ffff" summary="formulario">
          <tr>
              <th bgcolor="#ffebcd" colspan="2">Usuario </th>
            </tr>
          <tr>
              <td>Nombre:</td><td>$_POST[username]</td>
            </tr>
          <tr>
              <td>Email:</td><td>$_POST[email]</td>
            </tr>
          <tr>
              <td>Contraseña:</td><td>$_POST[password]</td>
            </tr>
          <tr>
              <td>Activado:</td><td>$txtEnabled</td>
            </tr>
          <tr>
              <td>Último acceso:</td><td>$txtLastLogin</td>
            </tr>
           <tr>
               <td>Token:</td><td>$txtToken</td>
           </tr>
        </table>
</br>

___MARCA_FIN;

} catch (Exception $exception) {
    echo <<<____ERROR
        <h2 align="center">Ha ocurrido un error.</h2>
____ERROR;
    echo $exception->getMessage();
}
?>
</body>
</html>
