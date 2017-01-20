<?php
require(".classes/controller.php");
session_start();
$msg = [];

if($_SERVER["SERVER_NAME"] != "corentinp.dijon.codeur.online") : ?>
<h1>PLEASE DON'T COPY MY WORK!</h1>
<?php exit;endif;

if(isset($_SESSION["username"])){
	header("Location: http://corentinp.dijon.codeur.online/Chat");
	exit;
}

if(isset($_POST["login"])) : 
	if(!isset($_POST["login"]) || $_POST["login"] == "" || !isset($_POST["password"]) || $_POST["password"] == ""){
		$msg[] = "Merci de renseigner tous les champs";
		$_SESSION["msg"] = $msg;
		header("Location: http://corentinp.dijon.codeur.online/Chat/login");
		exit;
	}

	if(isset($_POST["login"]) && isset($_POST["password"])){
		$clients = fopen(".data/db/users.csv","r");

		while($data = fgetcsv($clients,0,";")){
			if($data[0] == $_POST["login"] && $data[1] == sha1(md5("raton" + $_POST["password"] + "laveur"))){
				$_SESSION["username"] = $_POST["login"];
				$_SESSION["pseudo"] = $data[2];
				header("Location: http://corentinp.dijon.codeur.online/Chat");
				exit;
			}
		}
	}

	$msg[] = "Saisie incorrecte";
	$_SESSION["msg"] = $msg;
	header("Location: http://corentinp.dijon.codeur.online/Chat/login");
endif;
?>
<form action="login" method="post">
	<input type="text" name="login" placeholder="Login" />
	<input type="password" name="password" placeholder="Password" />
	<input type="submit" value="Envoyer" />
</form>
Register : Slack</br>
Generating the password : <a href="encrypt?pass=my_password" target="_blank">here</a>
<?php if(isset($_SESSION["msg"])) : 
foreach($_SESSION["msg"] as $messages) : ?>
<p><?=$messages;?></p>
<?php endforeach;?>
<?php endif;?>