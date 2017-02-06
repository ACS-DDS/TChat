<?php
session_start();
if(isset($_POST["nom"])) : 
	if(!isset($_POST["nom"]) || $_POST["nom"] == "" || !isset($_POST["prenom"]) || $_POST["prenom"] == "" || !isset($_POST["password"]) || $_POST["password"] == "" || !isset($_POST["mail"]) || $_POST["mail"] == "" || !isset($_POST["img"]) || $_POST["img"] == "" || !isset($_POST["pseudo"]) || $_POST["pseudo"] == ""){
		$errors[] = "Merci de renseigner tous les champs !";
		$_SESSION["errors"] = $errors;
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
		exit;
	}

	if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["password"]) && isset($_POST["mail"]) && isset($_POST["img"]) && isset($_POST["pseudo"])){
		$file = fopen(".data/db/users.csv","a");

		fputcsv($file,array($_POST["nom"],$_POST["prenom"],sha1(md5("raton" + $_POST["password"] + "laveur")),$_POST["mail"],$_POST["img"],$_POST["pseudo"],"logged-out"));
		fclose($file);

		$errors[] = "Vous avez bien été enregistré en tant que <b>" . $_POST["nom"] . "</b>, veuillez vous connecter pour acceder au site web !";
		$_SESSION["errors"] = $errors;

		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
		exit;
	}

	$errors[] = "Saisie incorrecte !";
	$_SESSION["errors"] = $errors;
	header("Location: http://corentinp.dijon.codeur.online/TChat/login");
endif;?>