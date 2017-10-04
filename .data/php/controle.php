<?php

session_start();

/* if($_SERVER['HTTP_REFERER'] != "./TChat/login"){
	header("Location: ./TChat/hotlink");
	exit;
} */
if(!isset($_SESSION["username"])) : 
	header("Location: ./TChat/login");
	exit;
endif;
?>