<?php
session_start();

if(!isset($_SESSION["username"])) : 
	header("Location: http://corentinp.dijon.codeur.online/TChat/login");
	exit;
else : 
	header("Location: http://corentinp.dijon.codeur.online/TChat");
	exit;
endif;
?>