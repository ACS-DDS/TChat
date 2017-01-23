<?php require(".data/php/controle.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>TChat - Index</title>

		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=PT+Sans+Caption">
		<link rel="stylesheet" type="text/css" href=".static/css/styles.css?<?=time();?>">

		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/3.1.1/jquery.min.js?<?=time();?>"></script>
	</head>
	<body>
		<div class="notif" id="success">
			<div class="succes">
				<p id="bienvenue">Bonjour et bienvenue sur TChat, <b>Jacques !</b></p>
			</div>
		</div>
		<div id="header">
			<h1 id="ch-name">random</h1>
			<input type="text" id="search" name="search" placeholder="🔍Rechercher">
			<input type="button" id="logout" name="logout" value="🚪">
		</div>
		<div id="footer">
			<form id="form" method="post">
				<input type="text" id="content" name="content" placeholder="Ecrivez votre message...">
				<!-- <input type="button" id="send" name="submit" value="Send" /> -->
				<input type="button" name="send" id="send" value="↩">
<?php if($_SESSION["username"] == "Corentin") : ?>
				<input type="button" id="reset" name="reset" value="Reset" />
<?php endif;?>
				<input type="hidden" id="author" name="author" value="Jacques">
			</form>
		</div>
		<div id="messages"></div>
		<div id="sidebar">
			<div id="channels">
				Channels
				<input type="button" id="createchannel" name="createchannel" value="+" />
				<ul id="ch"></ul>
			</div>
			<div id="pm">
				Direct Messages
				<input type="button" id="directmessage" name="directmessage" value="+" />
				<ul id="logged"></ul>
			</div>
		</div>
		<div id="copyright">
			<p class="date"></p>
			<p>Design by <a href="http://alexm.dijon.codeur.online" target="_blank">@Alex</a> & <a href="http://corentinp.dijon.codeur.online" target="_blank">@Kasai.</a></p>
		</div>
		<script type="text/javascript">
			var channel = "general";
			$(document).ready(function(){
				window.location="#success";
				setTimeout(function(){window.location="#";},1500);
				$(".date").html("© Corentin PERROT | "+d.getFullYear());
				$(window).on("unload",logout);
				$("#form").submit(send);
<?php if($_SESSION["username"] == "Corentin") : ?>
				$("#reset").click(reset);
				//$("#").click(deletechannel);
<?php endif;?>
				$("#createchannel").click(createchannel);
				$("#logout").click(logout);
				login();
			});
			var d=new Date();
			var login=function(){$.ajax({url:"act.php",method:"POST",data:"login=<?=$_SESSION['username'];?>"})};
			var get=function(){$.ajax({url:"act.php",method:"POST",data:"channel="+channel+"&get",success:function(data){$("#messages").html(data);$("#messages").animate({scrollTop:$("#messages").get(0).scrollHeight},2000)}})};
			var logout=function(){$.ajax({url:"act.php",method:"POST",data:"logout=<?=$_SESSION['username'];?>",success:function(){window.location="http://corentinp.dijon.codeur.online/TChat/login"}})};
<?php if($_SESSION["username"] == "Corentin") : ?>
			var reset=function(){$.ajax({url:"act.php",method:"POST",data:"channel="+channel+"&reset"})};
			var deletechannel=function(){$.ajax({url:"act.php",method:"POST",data:"deletechannel="+channel})};
<?php endif;?>
			var createchannel=function(){var ch_name = prompt("Entrez le nom de votre Channel");$.ajax({url:"act.php",method:"POST",data:"createchannel="+ch_name})};
			var users=function(){$.ajax({url:"act.php",method:"POST",data:"users",success:function(data){$("#logged").html(data);}})};
			var channels=function(){$.ajax({url:"act.php",method:"POST",data:"channels",success:function(data){$("#ch").html(data);}})};
			var send=function(e){var author=encodeURIComponent($("#author").val());var content=encodeURIComponent($("#content").val());if(author!=""&&content!=""){$.ajax({url:"act.php",method:"POST",data:"channel="+channel+"&author="+author+"&content="+content,success:function(){$("#content").val("")}})}e.preventDefault();};
			var change=function(id){$.ajax({url:"act.php",method:"POST",data:"change=" + id,success:function(data){$("#messages").html(data);}});$("#ch-name").html(id);};
			var it_get = setInterval(get,1000);
			var it_users = setInterval(users,1000);
			var it_channels = setInterval(channels,1000);
		</script>
	</body>
</html>