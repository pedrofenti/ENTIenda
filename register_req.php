<?php


if(!isset($_POST["user"]) || !isset($_POST["pass"]) || !isset($_POST["re_pass"]) || !isset($_POST["name"]) || !isset($_POST["surnames"]) || !isset($_POST["email"]) || !isset($_POST["birthdate"])){
	echo "ERROR 1: Campos no rellenados";
	exit(1);
}

$user = trim($_POST["user"]);
if(strlen($user) <= 2){
	echo "ERROR 2: Usuario mal formado";
	exit(2);
}

$pass = trim($_POST["pass"]);
if(strlen($pass) <= 3){
	echo "ERROR 3: Contraseña mal formada";
	exit(3);
}

$repass = trim($_POST["re_pass"]);
if($pass != $repass){
	echo "ERROR 4: Las contraseñas no coinciden";
	exit(4);
}

$name = trim($_POST["name"]);
$surname = trim($_POST["surnames"]);
$email = trim($_POST["email"]);
$birthday = trim($_POST["birthdate"]);
$tmp = addslashes($user);

if(strlen($tmp) != strlen($user)){
	echo "ERROR 5: Intentan hackear el username";
	exit(5);
}

$user = $tmp;
$tmp = addslashes($pass);

if(strlen($tmp) != strlen($pass)){
	echo "ERROR 6: Intentan hackear el password";
	exit(6);
}

$pass = md5($tmp);
$tmp = addslashes($name);

if(strlen($tmp) != strlen($name)){
	echo "ERROR 7: Intentan hackear el name";
	exit(7);
}

$name = $tmp;
$tmp = addslashes($surname);

if(strlen($tmp) != strlen($surname)){
	echo "ERROR 8: Intentan hackear el surname";
	exit(8);
}

$surname = $tmp;

$query = <<<EOD
INSERT INTO users (user, password, email, name, surname, birthdate)
 VALUES ('{$user}','{$pass}','{$email}','{$name}','{$surname}','{$birthday}');
EOD;

require("config.php");

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);

if(!$conn){
	echo "ERROR 9: Mala conexión";
	exit(9);
}

$res = $conn->query($query);

if(!$res){
	echo "ERROR 10: Query mal formada";
	exit(10);
}

$id_user = mysqli_insert_id($conn);

session_start();

$_SESSION['id_user'] = $id_user;

echo "registrado";

header("Location: index.php");

exit();

?>
