<?php
require_once(".classes/controller.php");

session_start();
setlocale(LC_TIME,"fr_FR");
$_SESSION["TChat"] = new Controller();
$_POST["date"] = microtime(true);

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
	$_SESSION["TChat"] = new Controller($_POST["channel"]);
	$_SESSION["TChat"]->addMessages(array_map("trim",$_POST));
endif;

// CREATECHANNEL
if(isset($_POST["createchannel"])) : 
	$_SESSION["TChat"]->createChannel($_POST["createchannel"]);
endif;

// DELETECHANNEL
if(isset($_POST["deletechannel"])) : 
	$_SESSION["TChat"]->deleteChannel($_POST["deletechannel"]);
endif;

// DELETEUSER
if(isset($_POST["deleteuser"])) : 
	$_SESSION["TChat"]->deleteUser($_POST["deleteuser"]);
endif;

// CHANNELS
if(isset($_POST["channels"])) : 
	$dir   = ".data/db/channels";
	$files = array_diff(scandir($dir),array(".",".."));
	$ext   = array(".csv");

	$out = str_replace($ext,"",$files);
foreach($out as $id => $channel) : ?>
<li>
	<a id="ch-<?=$id;?>" name="<?=$channel;?>" href="#" onclick="channel = this.name;change(this.name)"><?=$channel;?></a>
	<input type="button" id="suppr" name="<?=$channel;?>" onclick="channel = this.name;deletechannel(this.name)" value="✖">
</li>
<?php endforeach; endif;

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

// USERS
if(isset($_POST["users"])) : 
	$items = $_SESSION["TChat"]->getMembers();
	if(!empty($items)) : 
		foreach($items as $item) :
			echo $item;
		endforeach;
	endif;
endif;

// GET
if(isset($_POST["get"])) : 
	$_SESSION["TChat"] = new Controller($_POST["channel"]);
	$items = $_SESSION["TChat"]->getMessages();
	if(!empty($items)) : 
		foreach($items as $item) :
			echo $item;
		endforeach;
	endif;
endif;

// LOGIN
if(isset($_POST["login"])) : 
	$_SESSION["TChat"]->login($_POST["login"]);
endif;

// RESET
if(isset($_POST["reset"])) : 
	$_SESSION["TChat"] = new Controller($_POST["channel"]);
	$_SESSION["TChat"]->resetMessages();
endif;

// LOGOUT
if(isset($_POST["logout"])) : 
	$_SESSION["TChat"]->logout($_POST["logout"]);

	session_destroy();
endif;