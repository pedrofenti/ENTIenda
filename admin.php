<?php
require("template.php");

session_start();

if(!isset($_SESSION["id_user"])){
	echo "Es obligatorio identificarse!";
	exit();
}

if(intval($_SESSION["id_user"]) != 1){
	echo "No tienes permiso para estar aqui!";
	exit();
}

$content = <<<EOD
<nav>
<ul>
<li><a href="product.php">Insert product</a></li>
<li><a href="groups.php">Insert group</a></li>
</ul>
</nav>
EOD;
showHeader("ENTIenda ADMIN");
showContent($content);
showFooter();

?>
