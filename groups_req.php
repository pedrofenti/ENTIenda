<?php

session_start();

require("config.php");

if (!isset($_SESSION["id_user"])){
	echo "ERROR 1: Incicia session";
	exit();
}

if ($_SESSION["id_user"] != 1){
	echo "ERROR 2: Usuario incorrecto";
	exit();
}

if (!isset($_POST["group"]) || !isset($_POST["course"]) || !isset($_POST["jam_year"]) || !isset($_POST["mark"])){
	echo "ERROR 3: Formulario inclompleto";
	exit();
}

$group = $_POST["group"];
$course = $_POST["course"];
$jam_year = $_POST["jam_year"];
$mark = $_POST["mark"];

$query = <<<EOD
INSERT INTO groups (`group`, course, jam_year, mark) VALUES ('{$group}', '{$course}', '{$jam_year}', '{$mark}');
EOD;

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);

$res = $conn->query($query);

if (!$res){
	echo "ERROR 4: Error al insertar";
	exit();
}

Header("Location: index.php");
?>
