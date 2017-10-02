<?php
require(".classes/controller.php");
session_start();
$errors = [];

$_SESSION["TChat"] = new Controller();

if(isset($_SESSION["username"])){
	header("Location: ./TChat");
	exit;
}

if(isset($_POST["nom"])) : 
	echo var_dump($_POST);
	if(!isset($_POST["nom"]) || $_POST["nom"] == "" || !isset($_POST["prenom"]) || $_POST["prenom"] == "" || !isset($_POST["password"]) || $_POST["password"] == ""){
		$errors[] = "Merci de renseigner tous les champs";
		$_SESSION["errors"] = $errors;
		header("Location: ./TChat/login");
		exit;
	}

	if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["password"])){
		$file = fopen(".data/db/users.csv","r");

		while($data = fgetcsv($file,0)){
			if($data[0] == $_POST["nom"] && $data[1] == $_POST["prenom"] && $data[2] == sha1(md5("raton" + $_POST["password"] + "laveur"))){
				$_SESSION["username"] = $_POST["nom"] . " " . $_POST["prenom"];
				header("Location: ./TChat");
				exit;
			}
		}
	}

	$errors[] = "Saisie incorrecte";
	$_SESSION["errors"] = $errors;
	header("Location: ./TChat/login");
endif;?>
<html>
	<head>
		<title>TChat - Login</title>

		<link rel="stylesheet" href="./static/css/login.css?<?=microtime(true);?>">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans+Caption">
	</head>
	<body>
		<div class="log1">
			<h2 id="login">Veuillez vous connecter</h2>
			<form id="login_erg" action="login" method="post">
				<input id="nom" type="text" name="nom" placeholder="Nom">
				<input id="prenom" type="text" name="prenom" placeholder="Prénom">
				<input id="password" type="password" name="password" placeholder="Mot de passe">
				<input id="send" type="submit" value="🔓">
			</form>

			<h2 id="register">Tu es nouveau ? Inscris-toi !</h2>
			<form id="login_ins" action="register" method="post">
				<input id="nom" type="text" name="nom" placeholder="Nom">
				<input id="prenom" type="text" name="prenom" placeholder="Prénom"><br/>
				<input id="password" type="password" name="password" placeholder="Mot de passe">
				<input id="mail" type="mail" name="mail" placeholder="Adresse e-mail"><br/>
				<input id="img" type="text" name="img" placeholder="Image de profil">
				<input id="pseudo" type="text" name="pseudo" placeholder="Pseudo"><br/>
				<input id="send" type="submit" value="✔">
			</form>

			<!-- <h2 id="guest">Connecte toi en tant qu'invité !</h2>
			<form id="btn_guest" action="login" method="post">
				<input type="hidden" name="login" value="guest">
				<input id="log_guest" type="submit" value="Se connecter en tant qu'invité">
			</form> -->

<?php if(isset($_SESSION["errors"])) : ?>

			<h2 id="error">Error!</h2>
<?php foreach($_SESSION["errors"] as $messages) : µ?>
			<p class="errors"><?=$messages;?></p>
<?php endforeach;endif;?>
		</div>
		<div id="copyright">
			<p class="date"></p>
			<p>Design by <a href="http://alexm.dijon.codeur.online" target="_blank">@Alex</a></p>
		</div>
	</body>
</html>
<?php session_destroy(); ?>
