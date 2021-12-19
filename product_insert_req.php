<?php

session_start();

if (!isset($_SESSION["id_user"])){
	echo "ERROR 1: Incicia sessión";
	exit();
}

if ($_SESSION["id_user"] != 1){
	echo "ERROR 2: Usuario incorrecto";
	exit();
}

if (!isset($_POST["product"]) || !isset($_POST["description"]) || !isset($_POST["price"]) || !isset($_POST["reference"]) || !isset($_POST["discount"]) || !isset($_POST["units_sold"]) || !isset($_POST["website"]) || !isset($_POST["size"]) || !isset($_POST["duration"]) || !isset($_POST["release_date"]) ||  !isset($_POST["id_group"]) || !isset($_POST["id_engine_version"])){
	echo "ERROR 3: Formulario inclompleto";
	exit();
}

$product = $_POST["product"];
$description = $_POST["description"];
$price = $_POST["price"];
$reference = $_POST["reference"];
$discount = $_POST["discount"];
$units_sold = $_POST["units_sold"];
$website = $_POST["website"];
$size = $_POST["size"];
$duration = $_POST["duration"];
$release_date = $_POST["release_date"];
$id_group = intval($_POST["id_group"]);
$id_engine_version = intval($_POST["id_engine_version"]);

$query = <<<EOD
INSERT INTO products (product, description, price, reference, discount, units_sold, website, size, duration, release_date, id_group, id_engine_version)
VALUES ("{$product}", "{$description}", "{$price}", "{$reference}", "{$discount}", "{$units_sold}", "{$website}", "{$size}", "{$duration}", "{$release_date}", {$id_group}, {$id_engine_version});
EOD;

require("config.php");

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);

$res = $conn->query($query);

if (!$res){
	echo "ERROR 4: Error al insertar";
	exit();
}

$id_product = mysqli_insert_id($conn);

header("Location: shop.php?id_product=".$id_product);

exit();

?>
