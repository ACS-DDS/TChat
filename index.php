<?php require(".data/php/controle.php");?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Chat PHP & AJAX</title>

		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/3.1.1/jquery.min.js"></script>

		<style type="text/css" media="screen">
			div#header {
			    background: blue;
			    position: fixed;
			    top: 0;
			    left: 0;
			    width: 100%;
			    height: 45px;
			    margin: auto;
			    text-align: center;
			    box-shadow: 0px 6px 6px blue;
			}
			div#header form{
				margin:5px auto;
			}
			div#message{
			    background: grey;
			    padding: 5px;
			    border-radius: 5px;
			    width: 50%;
			    margin: 10px 10%;
			}
			div#message:first-child{
			    background: grey;
			    padding: 5px;
			    border-radius: 5px;
			    width: 50%;
			    margin: 60px 10% 0;
			}
			div#message:last-child{
			    background: pink;
			}
			p.content{
				font-style:italic;
			}
			p.author{
				font-size:20px;
			}
			p{
				margin:0;
			}
			form>p{
				color:white;
			}
			div#messages{
				widows:78.3%;
				margin:0px;
			}
			div#utilisateurs{
				font-weight:bold;
				background:red;
				position:fixed;
				top:0;
				bottom:0;
				right:0;
				padding:1%;
				width:20%;
			}
			div#utilisateur{
				margin:0 0 5%;
			}
			.logged{
				color:#00e800;
			}
		</style>
	</head>
	<body>
		<div id="header">
			<form method="post">
				<p>Bienvenue, <b><?=$_SESSION["username"];?></b>.</p>
				
				<input type="text" id="content" name="content" placeholder="Message" />
				<input type="button" id="send" name="submit" value="Send" />
				<input type="button" id="logout" name="logout" value="Logout" />
<?php if($_SESSION["username"] == "Corentin") : ?>
				<input type="button" id="reset" name="reset" value="Reset" />
<?php endif;?>
				<input type="hidden" id="author" name="author" value="<?=$_SESSION['username'];?>" />
			</form>
		</div>
		<div id="messages"></div>
		<div id="utilisateurs"></div>
		<script type="text/javascript">
			$("#send").click(function(e){
				e.preventDefault();

				var author = encodeURIComponent($("#author").val());
				var content = encodeURIComponent($("#content").val());

				if(author != "" && content != ""){
					$.ajax({
						url:"act.php",
						method:"POST",
						data:"author=" + author + "&content=" + content,
						success:function(){
							$("#content").val("");
						}
					});
				}
			});

			$("#reset").click(function(){
				$.ajax({
					url:"act.php",
					method:"POST",
					data:"reset"
				});
			});

			$("#logout").click(function(){
				$.ajax({
					url:"act.php",
					method:"POST",
					data:"logout=" + "<?=$_SESSION['pseudo'];?>"
				}).done(function(){
					window.location = "http://corentinp.dijon.codeur.online/Chat/login";
				});
			});

			var login = function(){
				$.ajax({
					url:"act.php",
					method:"POST",
					data:"login=" + "<?=$_SESSION['pseudo'];?>"
				})
			}

			var logged = function(){
				$.ajax({
					url:"act.php",
					method:"POST",
					data:"logged",
					success:function(result){
						$("#utilisateurs").first().html(result);
					}
				})
			}

			var get = function(){
				$.ajax({
					url:"act.php",
					method:"POST",
					data:"get",
					success:function(result){
						$("#messages").first().html(result);
						$("html,body").animate({scrollTop:$("html,body").get(0).scrollHeight},1000);
					}
				})
			}
			setInterval(get,1000);
			setInterval(logged,1000);
			login();
		</script>
	</body>
</html>