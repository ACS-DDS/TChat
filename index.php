<?php require(".data/php/controle.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>TChat - Index</title>

		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=PT+Sans+Caption|Ubuntu">
		<link rel="stylesheet" type="text/css" href=".static/css/styles.css?<?=microtime(true);?>">

		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/3.1.1/jquery.min.js?<?=microtime(true);?>"></script>
	</head>
	<body>
		<div class="notif" id="success">
			<div class="succes">
				<p id="bienvenue">Bonjour et bienvenue sur TChat, <b><?=$_SESSION["username"];?> !</b></p>
			</div>
		</div>
		<div id="header">
			<h1 id="ch-name"></h1>
<?php if($_SESSION["username"] == "PERROT Corentin" || $_SESSION["username"] == "acs dds") : ?>
			<input type="button" id="reset" name="reset" value="Reset" />
<?php endif;?>
			<input type="text" id="search" name="search" placeholder="🔍Rechercher">
			<input type="button" id="logout" name="logout" value="🚪">
		</div>
		<div id="footer">
			<form id="form" method="post">
				<input type="text" id="content" name="content" placeholder="Ecrivez votre message...">
				<input type="button" id="send" name="submit" value="↩">
				<input type="hidden" id="author" name="author" value="<?=$_SESSION["username"];?>">
			</form>
		</div>
		<div id="messages"></div>
		<div id="sidebar">
			TChat
			<ul id="user-logged">
				<li class="logged"><?=$_SESSION["username"];?></li>
			</ul>
			<div id="channels">
				Channels
				<input type="button" id="createchannel" name="createchannel" value="+">
				<ul id="ch"></ul>
			</div>
			<div id="pm">
				Direct Messages
				<!-- <input type="button" id="directmessage" name="directmessage" value="+"> -->
				<ul id="logged"></ul>
			</div>
		</div>
		<div id="copyright">
			<p class="date"></p>
			<p>Design by <a href="http://alexm.dijon.codeur.online" target="_blank">@Alex</a> & <a href="http://corentinp.dijon.codeur.online" target="_blank">@Kasai.</a></p>
			<p>Assistant Technique: <a href="http://yassinl.dijon.codeur.online" target="_blank">@CrackJ</a></p>
		</div>
		<script type="text/javascript">
			var channel = "general",user,ch_name,a,c;
			$(document).ready(function(){
				window.location="#success";
				setTimeout(function(){window.location="#";},1500);
				$(".date").html("© Corentin PERROT | "+d.getFullYear());
				$("#ch-name").html(channel);
				$(window).on("unload",logout);
				$("#form").submit(send);
				$("#send").click(send);
<?php if($_SESSION["username"] == "PERROT Corentin" || $_SESSION["username"] == "acs dds") : ?>
				$("#reset").click(resetChannel);
<?php endif;?>
				$("#createchannel").click(createChannel);
				$("#logout").click(logout);
				setTimeout(function(){$("#messages").animate({scrollTop:$("#messages").get(0).scrollHeight},2000);},500);
				login();
			});
			var d=new Date();
			var login=function(){$.ajax({url:"act.php",method:"POST",data:"login=<?=$_SESSION['username'];?>"})};
			var logout=function(){$.ajax({url:"act.php",method:"POST",data:"logout=<?=$_SESSION['username'];?>",success:function(){window.location="./login";}})};
			var send=function(e){a=encodeURIComponent($("#author").val());c=encodeURIComponent($("#content").val());if(a!=""&&c!=""){$.ajax({url:"act.php",method:"POST",data:"channel="+channel+"&author="+a+"&content="+c,success:function(){$("#content").val("")}})}e.preventDefault();};
<?php if($_SESSION["username"] == "PERROT Corentin" || $_SESSION["username"] == "acs dds") : ?>
			var deleteChannel=function(a){$.ajax({url:"act.php",method:"POST",data:"channel="+a+"&delete"})};
			var deleteMessage=function(a,b){$.ajax({url:"act.php",method:"POST",data:"channel="+channel+"&message="+a+"&time="+b+"&delete"})}
			var deleteUser=function(a){$.ajax({url:"act.php",method:"POST",data:"usersdelete="+a+"&delete"})};
			var resetChannel=function(){$.ajax({url:"act.php",method:"POST",data:"channel="+channel+"&reset"})};
<?php endif;?>
			var createChannel=function(){ch_name=prompt("Entrez le nom de votre Channel");$.ajax({url:"act.php",method:"POST",data:"channel="+ch_name+"&create"})};
			var changeChannel=function(a){$.ajax({url:"act.php",method:"POST",data:"change="+a,success:function(data){$("#messages").html(data);}});$("#ch-name").html(a);};
			var getMessages=function(){$.ajax({url:"act.php",method:"POST",data:"get&channel="+channel,success:function(data){$("#messages").html(data);}})};
			var getUsers=function(){$.ajax({url:"act.php",method:"POST",data:"get&users",success:function(data){$("#logged").html(data);}})};
			var getChannels=function(){$.ajax({url:"act.php",method:"POST",data:"get&channels",success:function(data){$("#ch").html(data);}})};
			var it_get = setInterval(getMessages,1000);
			var it_users = setInterval(getUsers,1000);
			var it_channels = setInterval(getChannels,1000);
		</script>
	</body>
</html>