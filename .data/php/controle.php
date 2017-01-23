<?php
session_start();

if(!isset($_SESSION["username"])){
	header("Location: http://corentinp.dijon.codeur.online/TChat/login");
	exit;
}

if($_SERVER["SERVER_NAME"] != "corentinp.dijon.codeur.online") : ?>
	<h1>PLEASE DON'T COPY MY WORK!</h1>
<?php exit;endif;
?>