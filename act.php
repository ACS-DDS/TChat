<?php
require_once(".classes/controller.php");

session_start();
setlocale(LC_TIME,"fr_FR");
$_SESSION["messages"] = new Controller();
$_POST["date"] = time();

/*echo "</br> ---- </br>";
echo "act.php (post) : ";
var_dump($_POST);
echo "</br> ---- </br>";

echo "</br> ---- </br>";
echo "act.php (session) : ";
var_dump($_SESSION);
echo "</br> ---- </br>";*/

// POST
if(isset($_POST["author"])) : 
	$_SESSION["messages"]->addMessages($_POST);
endif;

// GET
if(isset($_POST["get"])) : 
	$items = $_SESSION["messages"]->getMessages();
	if(!empty($items)) : 
		foreach($items as $item) :
			echo $item;
		endforeach;
	endif;
endif;

// LOGIN
if(isset($_POST["login"])) : 
	$_SESSION["messages"]->login($_POST["login"]);
endif;

// LOGGED
if(isset($_POST["logged"])) : 
	$items = $_SESSION["messages"]->logged();
	if(!empty($items)) : 
		foreach($items as $item) :
			echo $item;
		endforeach;
	endif;
endif;

// RESET
if(isset($_POST["reset"])) : 
	$_SESSION["messages"]->resetMessages();
endif;

// LOGOUT
if(isset($_POST["logout"])) : 
	$_SESSION["messages"]->logout($_POST["logout"]);

	unset($_SESSION["username"]);
	session_destroy();
endif;