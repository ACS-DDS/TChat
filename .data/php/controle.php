<?php
session_start();

/*if($_SERVER['HTTP_REFERER'] != "http://corentinp.dijon.codeur.online/TChat/login"){
	header("Location: http://corentinp.dijon.codeur.online/TChat/hotlink");
	exit;
}*/
if(!isset($_SESSION["username"])) : 
	header("Location: http://corentinp.dijon.codeur.online/TChat/login");
	exit;
endif;
?>