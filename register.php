<?php

session_start();

require("config.php");
require("template.php");

//$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);

#Contenidos
$title = "Register ENTIenda";

$content = <<<EOD
<form method="post" action="register_req.php">
<h2>Registrate</h2>

<p><label for="register-user">Usuario:</label> <input type="text" name="user" id="register-user" /></p>
<p><label for="register-name">Nombre:</label> <input type="text"name="name" id="register-name" /></p>
<p><label for="register-surnames">Apellidos:</label> <input type="text" name="surnames" id="register-surnames" /></p>
<p><label for="register-email">Email:</label> <input type="email" name="email" id="register-mail" /></p>
<p><label for="register-birthdate">Cumpleaños:</label> <input type="date" name="birthdate" id="register-birthdate" /></p>

<p><label for="register-pass">Contraseña:</label> <input type="password" name="pass" id="register-pass"/></p>
<p><label for="confirm-pass">Confirma contraseña:</label> <input type="password" name="re_pass" id="confirm-pass"/></p>

<p><input type="submit" id="register-submit" value="Register"/></p>

</form>
EOD;

showHeader($title);

showContent($content);

showFooter();

?>
