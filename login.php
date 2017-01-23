<?php
require(".classes/controller.php");
session_start();
$msg = [];

if($_SERVER["SERVER_NAME"] != "corentinp.dijon.codeur.online") : ?>
<h1>PLEASE DON'T COPY MY WORK!</h1>
<?php exit;endif;

if(isset($_SESSION["username"])){
	header("Location: http://corentinp.dijon.codeur.online/TChat");
	exit;
}

if(isset($_POST["login"])) : 
	if(!isset($_POST["login"]) || $_POST["login"] == "" || !isset($_POST["password"]) || $_POST["password"] == ""){
		$msg[] = "Merci de renseigner tous les champs";
		$_SESSION["msg"] = $msg;
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
		exit;
	}

	if(isset($_POST["login"]) && isset($_POST["password"])){
		$clients = fopen(".data/db/users.csv","r");

		while($data = fgetcsv($clients,0)){
			if($data[0] == $_POST["login"] && $data[1] == sha1(md5("raton" + $_POST["password"] + "laveur"))){
				$_SESSION["username"] = $_POST["login"];
				header("Location: http://corentinp.dijon.codeur.online/TChat");
				exit;
			}
		}
	}

	$msg[] = "Saisie incorrecte";
	$_SESSION["msg"] = $msg;
	header("Location: http://corentinp.dijon.codeur.online/TChat/login");
endif;?>
<html>
<head>
<title>TChat - Login</title>
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption" rel="stylesheet">
</head>
<body>
<style type="text/css">
	.log1{
		background-color: #3A3C3D;
		width: 50%;
		height: 60%;
		margin: auto;
		margin-top: 8%;
		box-shadow: 3px 3px 3px 3px black;
	}
	#login_erg{
		text-align: center;
		padding-top: 120px;
	}
	#pseudo{
		padding: 1%;
		outline: none;
		border: 2px solid black;
	}
	#password{
		padding: 1%;
		outline: none;
		border: 2px solid black;
	}
	#login{
		padding: 1%;
		outline: none;
		border: 2px solid black;
		background-color: #fff;
	}
	#login:hover{
		background-color: #272829;
		border: 2px solid green;
	}
	#login:active{
		background-color: #181919;
	}
	#btn_guest{
		margin-left: 84%;
		margin-top: 35px;
	}
	#log_guest{
		padding: 5%;
		margin-top: -60px;
		border: 2px solid orange;
		background-color: #fff;
		font-family: 'PT Sans Caption', sans-serif;
		outline: none;
	}
	#log_guest:hover{
		border: 2px solid #fff;		
		background-color: orange;
		color: #fff;
	}
	#log_guest:active{
		background-color: #916E00;
	}
	h3{
		margin-bottom: -60px;
		padding-top: 30px;
		text-align: center;
		font-family: 'PT Sans Caption', sans-serif;
		color: #fff;
		font-size: 25px;
		border-bottom: 2px solid #fff;
	}
	h4{
		padding-top: 20px;
		margin-bottom: 60px;
		text-align: center;
		font-family: 'PT Sans Caption', sans-serif;
		color: #fff;
		font-size: 25px;
		border-bottom: 2px solid #fff;	
	}
	#login_ins{
		text-align: center;
	}
	#p_user{
		margin-top: 90px;
		margin-left: 55%;
		color: #fff;
		font-size: 14px;
		font-family: 'PT Sans Caption', sans-serif;
	}
	#copyright{
	    position:fixed;
	    bottom:20px;
	    left:20px;
	    font-size:10px;
	}
</style>
	<div class="log1">
		<h3>Veuillez vous connecter</h3>
		<form id="login_erg" action="login" method="post">
			<input id="pseudo" type="text" name="login" placeholder="Nom">
			<input id="password" type="password" name="password" placeholder="Mot de passe">
			<input id="login" type="submit" value="🔓">
		</form>

		<h4>Tu es nouveau ? Inscris-toi !</h4>
		<form id="login_ins" action="register" method="post">
			<input id="pseudo" type="text" name="login" placeholder="Nom">
			<input id="password" type="password" name="password" placeholder="Mot de passe">
			<input id="pseudo" type="text" name="pseudo" placeholder="Pseudo">
			<input id="login" type="submit" value="✔">
		</form>

		<!-- 	<p id="p_user">Se connecter en tant qu'inviter:</p>
		<form id="btn_guest" action="login" method="post">
			<input type="hidden" name="login" value="Guest">
			<input type="hidden" name="password" value="1234">
			<input id="log_guest" type="submit" value="Login as Guest">
		</form -->
	</div>
<?php if(isset($_SESSION["msg"])) : foreach($_SESSION["msg"] as $messages) : ?>
	<p><?=$messages;?></p>
<?php endforeach;endif;?>
	<div id="copyright">
		<p class="date"></p>
		<p>Design by <a href="http://alexm.dijon.codeur.online" target="_blank">@Alex</a></p>
	</div>
</body>