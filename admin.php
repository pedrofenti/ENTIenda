<?php

session_start();

if (!isset($_SESSION["id_user"])){
	echo "ERROR 1: Es obligatorio identifiacarse!";
	exit();
}

if (intval($_SESSION["id_user"]) != 1){
	echo "ERROR 2: No tienes permiso para estar aquí!";
	exit();
}

require("template.php");
require("config.php");

$title = "Entienda Admin";
$content = "";

$id_product = 0;
if (isset($_GET["id_product"]))
	$id_product = intval($_GET["id_product"]);

$groups = "";
$engine = "";

	$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);

	$query = <<<EOD
SELECT * FROM groups;
EOD;

  $res = $conn->query($query);

	while($sel = $res->fetch_assoc()){
		$groups.= <<<EOD
<option value="{$sel['id_group']}">{$sel['group']}</option>
EOD;
}

	$query = <<<EOD
SELECT * FROM engines;
EOD;

	 $res = $conn->query($query);
	 
	 while($sel = $res->fetch_assoc()){
	 	 $engine.= <<<EOD
<option value="{$sel['id_engine']}">{$sel['engine']}</option>
EOD;
}

if ($id_product == 0){
	$content = <<<EOD
<form method="post" action="product_insert_req.php" id="product-form">
<h2>Inserción de nuevo producto</h2>
<p><label for="product">Product</label><input type="text" name="product" id="product" /></p>
<p><label for="description">Description</label><input type="text" name="description" id="description" /></p>
<p><label for="price">Price</label><input type="text" name="price" id="price" /></p>
<p><label for="reference">Reference</label><input type="text" name="reference" id="reference" /></p>
<p><label for="discount">Discount</label><input type="text" name="discount" id="discount" /></p>
<p><label for="units_sold">Units sold</label><input type="text" name="units_sold" id="units_sold" /></p>
<p><label for="website">Website</label><input type="text" name="website" id="website"/></p>
<p><label for="size">Size</label><input type="text" name="size" id="size" /></p>
<p><label for="Duration">Duration</label><input type="text" name="duration" id="duration" /></p>
<p><label for="release_date">Release date</label><input type="date" name="release_date" id="release_date" /></p>
<p><label>Grupos: </label><select name="id_group">{$groups}</select></p>
<p><label>Engine version: </label><select name="id_engine_version">{$engine}</select></p>
<p><input type="submit" /></p>
</form>
EOD;
}
else{
	require("config.php");

	$conn = mysqli_connect($db_server, $db_user, $db_pass, $db);
	
	$query = <<<EOD
SELECT * FROM products WHERE id_product={$id_product};
EOD;

	$res = $conn->query($query);

	if (!$res){
		echo "ERROR 3: Producto erroneo";
		exit();
	}

	if ($res->num_rows != 1){
		echo "ERROR 4: Producto no existe";
		exit();
	}

	$prod = $res->fetch_assoc();

	$content = <<<EOD
<form method="post" action="product_update_req.php" id="product-form">
<input type="hidden" name="id_product" value="{$prod["id_product"]}" />
<h2>Actualización producto</h2>
<p><label for="product">Product</label>
	<input type="text" name="product" id="product" value="{$prod["product"]}" /></p>
<p><label for="description">Description</label><input type="text" name="description" id="description"  value="{$prod["description"]}" /></p>
<p><label for="price">Price</label><input type="text" name="price" id="price"  value="{$prod["price"]}" /></p>
<p><label for="reference">Reference</label><input type="text" name="reference" id="reference"  value="{$prod["reference"]}" /></p>
<p><label for="discount">Discount</label><input type="text" name="discount" id="discount"  value="{$prod["discount"]}" /></p>
<p><label for="units_sold">Units sold</label><input type="text" name="units_sold" id="units_sold" value="{$prod["units_sold"]}" /></p>
<p><label for="website">Website</label><input type="text" name="website" id="website"  value="{$prod["website"]}" /></p>
<p><label for="size">Size</label><input type="text" name="size" id="size"  value="{$prod["size"]}" /></p>
<p><label for="duration">Duration</label><input type="text" name="duration" id="duration" value="{$prod["duration"]}" /></p>
<p><label for="release_date">Release date</label><input type="date" name="release_date" id="release_date" value="{$prod["release_date"]}" /></p>
<p><label>Grupos: </label><select name="id_group">{$groups}</select></p>
<p><label>Engine version: </label><select name="id_engine_version">{$engine}</select></p>
<p><input type="submit" /></p>
</form>
EOD;
}

showHeader($title);

showContent($content);

showFooter();  
