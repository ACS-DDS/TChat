<?php

if(count($_POST) > 0) : 
	require_once(".classes/controller.php");

	session_start();
	setlocale(LC_TIME,"fr_FR");
	$_POST["date"] = microtime(true);

	// LOGIN & LOGOUT
	if(isset($_POST["login"]) || isset($_POST["logout"])) : 
		$_SESSION["TChat"] = new Controller();

		// LOGIN
		if(isset($_POST["login"])) : 
			$_SESSION["TChat"]->login($_POST["login"]);
		endif;

		// LOGOUT
		if(isset($_POST["logout"])) : 
			$_SESSION["TChat"]->logout($_POST["logout"]);
		endif;
	endif;

	// CHANNEL
	if(isset($_POST["channel"])) : 
		$_SESSION["TChat"] = new Controller($_POST["channel"]);

		// DELETE
		if(isset($_POST["delete"])) : 
			// DELETE MESSAGE
			if(isset($_POST["message"])) : 
				$_SESSION["TChat"]->deleteMessage($_POST["message"],$_POST["time"]);
				var_dump($_POST);
			endif;

			// DELETE CHANNEL
			if(!isset($_POST["message"])) : 
				$_SESSION["TChat"]->deleteChannel($_POST["channel"]);
			endif;
		endif;

		// CREATE CHANNEL
		if(isset($_POST["create"])) : 
			$_SESSION["TChat"]->createChannel($_POST["channel"]);
		endif;

		// RESET CHANNEL
		if(isset($_POST["reset"])) : 
			$_SESSION["TChat"]->resetMessages();
		endif;

		// GET CHANNEL
		if(isset($_POST["get"])) : 
			$_SESSION["TChat"] = new Controller($_POST["channel"]);
			$items = $_SESSION["TChat"]->getMessages();
			if(!empty($items)) : 
				foreach($items as $item) :
					echo $item;
				endforeach;
			endif;
		endif;

		// POST CHANNEL
		if(isset($_POST["author"]) && isset($_POST["content"])) : 
			$_SESSION["TChat"]->addMessages(array_map("trim",$_POST));
		endif;
	endif;

	// USERS
	if(isset($_POST["users"])) : 
		$_SESSION["TChat"] = new Controller();

		// USERS GET
		if(isset($_POST["get"])) : 
			$a = $_SESSION["TChat"]->getMembers();
			if(!empty($a)) : 
				foreach($a as $b) :
					echo $b;
				endforeach;
			endif;
		endif;
	endif;

	// USERS DELETE
	if(isset($_POST["usersdelete"])) : 
		$_SESSION["TChat"]->deleteUser($_POST["usersdelete"]);
	endif;

	// CHANNELS
	if(isset($_POST["channels"])) : 
		$dir   = ".data/db/channels";
		$files = array_diff(scandir($dir),array(".",".."));
		$ext   = array(".csv");

		$out = str_replace($ext,"",$files);
	foreach($out as $id => $channel) : ?>
	<li>
		<a id="ch-<?=$id;?>" name="<?=$channel;?>" href="#" onclick="channel=this.name;changeChannel(this.name)"><?=$channel;?></a>
<?php if($_SESSION["username"] == "PERROT Corentin" || $_SESSION["username"] == "acs dds") : ?>
		<input type="button" id="suppr" name="<?=$channel;?>" onclick="deleteChannel(this.name)" value="✖">
<?php endif;?>
	</li>
	<?php endforeach;endif;

	// CHANGE
	if(isset($_POST["change"])) : 
		$_SESSION["TChat"] = new Controller($_POST["change"]);
		$items = $_SESSION["TChat"]->changeChannel();
		if(!empty($items)) : 
			foreach($items as $item) :
				echo $item;
			endforeach;
		endif;
	endif;
endif;