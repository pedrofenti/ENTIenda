<?php

require("template.php");
require("config.php");

session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: User not logged";
	exit();
}

if(intval($_SESSION["id_user"]) != 1){
	echo "ERROR 2: User is not admin";
	exit();
}

$title = "Insert Group";
$content = "";

$content= <<<EOD
<form method="post" action="groups_req.php" id="group_form">
<p><label for="group">Group <label><input type="text" name="group" id="group" /></p>
<p><label for="course">Course </label><input type="text" name="course" id="course" /></p>
<p><label for="jam_year">Jam Year </label><input type="text" name="jam_year" id="jam_year" /></p>
<p><label for="mark">Mark </label><input type="text" name="mark" id="mark" /></p>
<p><input type="submit" value="Insert"/></p>
EOD;

showHeader($title);

showContent($content);

showFooter();

?>

