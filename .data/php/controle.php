<?php

session_start();

/* if($_SERVER['HTTP_REFERER'] != "./login"){
	header("Location: ./hotlink");
	exit;
} */
if (!isset($_SESSION["username"])) : 
	header("Location: ./login");
	exit;
endif;
?>