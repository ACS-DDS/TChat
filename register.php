<?php
if(isset($_POST["login"])) : 
	if(!isset($_POST["login"]) || $_POST["login"] == "" || !isset($_POST["password"]) || $_POST["password"] == ""){
		$msg[] = "Merci de renseigner tous les champs";
		$_SESSION["msg"] = $msg;
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
		exit;
	}

	if(isset($_POST["login"]) && isset($_POST["password"])){
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