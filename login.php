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
		<section id="auth">
			<section class="login">
				<h2>Veuillez vous connecter</h2>
				<form method="post">
					<input type="text" name="nom" placeholder="Nom">
					<input type="text" name="prenom" placeholder="Prénom">
					<input type="password" name="password" placeholder="Mot de passe">
					<input type="submit" value="🔓">
				</form>
			</section>
			<section class="register">
				<h2>Tu es nouveau ? Inscris-toi !</h2>
				<form action="register" method="post">
					<input type="text" name="nom" placeholder="Nom">
					<input type="text" name="prenom" placeholder="Prénom"><br>
					<input type="password" name="password" placeholder="Mot de passe">
					<input type="mail" name="mail" placeholder="Adresse e-mail"><br>
					<input type="text" name="img" placeholder="Image de profil">
					<input type="text" name="pseudo" placeholder="Pseudo"><br>
					<input type="submit" value="✔">
				</form>
			</section>
			<!-- <section class="guest">
				<h2>Connecte toi en tant qu'invité !</h2>
				<form method="post">
					<input type="hidden" name="login" value="guest">
					<input type="submit" value="✔">
				</form>
			</section> -->

<?php if(isset($_SESSION["errors"])) : ?>

			<h2 id="error">Error!</h2>
<?php foreach($_SESSION["errors"] as $messages) : µ?>
			<p class="errors"><?=$messages;?></p>
<?php endforeach;endif;?>
		</section>
		<section id="copyright">
			<p class="date"></p>
			<p>Design by <a href="http://alexm.dijon.codeur.online" target="_blank">@Alex</a></p>
		</section>
	</body>
</html>
<?php session_destroy(); ?>
