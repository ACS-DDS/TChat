<?php

if (count($_POST) > 0) : 
	require_once(".classes/controller.php");

	session_start();
	setlocale(LC_TIME, "fr_FR");
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
				$_SESSION["TChat"]->deleteMessage($_POST["message"], $_POST["time"]);
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
			$_SESSION["TChat"]->addMessages(array_map("trim", $_POST));
		endif;
	endif;

	// USERS
	if(isset($_POST["users"])) : 
		$_SESSION["TChat"] = new Controller();

		// USERS GET
		if(isset($_POST["get"])) : 
			$members = $_SESSION["TChat"]->getMembers();
			if(!empty($members)) : 
				foreach($members as $member) :
					echo $member;
				endforeach;
			endif;
		endif;
	endif;

	// USERS DELETE
	if(isset($_POST["usersdelete"])) : 
		$_SESSION["TChat"] = new Controller();
		$_SESSION["TChat"]->deleteUser(trim($_POST["usersdelete"]));
	endif;

	// CHANNELS
	if(isset($_POST["channels"])) : 
		$_SESSION["TChat"] = new Controller();

		// CHANNELS GET
		if(isset($_POST["get"])) : 
			$channels = $_SESSION["TChat"]->getChannels();
			if(!empty($channels)) : 
				echo $channels;
			endif;
		endif;
	endif;

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
