<?php

if (!isset($_POST["id_product"])){
	echo "ERROR 1: no hay producto";
	exit();
}

session_start();

if (!isset($_SESSION["id_user"])){
	echo "ERROR 2: No hay usuario";
	exit();
}

$id_product = intval($_POST["id_product"]);
if ($id_product == 0){
	echo "ERROR 3: Producto erroneo";
	exit();
}

require("config.php");

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);

$query = <<<EOD
INSERT INTO users_products (id_user, id_product)
VALUES ({$_SESSION["id_user"]},{$id_product});
EOD;

$res = $conn->query($query);
if (!$res){
	echo "ERROR 4: Error al insertar producto";
	exit();
}

header("Location: shop.php?id_product=".$id_product);
exit();
?>
