<?php
if(isset($_POST["nom"])) : 
	if(!isset($_POST["nom"]) || $_POST["nom"] == "" || !isset($_POST["prenom"]) || $_POST["prenom"] == "" || !isset($_POST["password"]) || $_POST["password"] == "" || !isset($_POST["mail"]) || $_POST["mail"] == "" || !isset($_POST["img"]) || $_POST["img"] == "" || !isset($_POST["pseudo"]) || $_POST["pseudo"] == ""){
		$msg[] = "Merci de renseigner tous les champs";
		$_SESSION["msg"] = $msg;
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
		exit;
	}

	if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["password"]) && isset($_POST["mail"]) && isset($_POST["img"]) && isset($_POST["pseudo"])){
		$file = fopen(".data/db/users.csv","a");
		fputcsv($file,array($_POST["login"],sha1(md5("raton" + $_POST["password"] + "laveur")),$_POST["pseudo"],"logged-out"));
		fclose($file);
		$msg[] = "Vous avez bien été ajoutté, veuillez donc vous connecter.";
		$_SESSION["msg"] = $msg;
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
		exit;
	}

	$msg[] = "Saisie incorrecte";
	$_SESSION["msg"] = $msg;
	header("Location: http://corentinp.dijon.codeur.online/TChat/login");
endif;?>