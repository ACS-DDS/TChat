<div id="message">
	<img src="https://d13yacurqjgara.cloudfront.net/users/49730/avatars/original/Logo.jpg" alt="Profile">

	<p class="author"><?=$this->author;?> <!--(?=$this->pseudo;?)--></p>
	<p class="content"><?=$this->message;?></p>
	<p class="time"><?=ucfirst(strftime("%A %e %B %Y à %k:%M:%S",$this->date));?></p>

	<input type="button" name="<?=$this->message;?>" id="clear" value="✕" onclick="deleteMessage(this.name);">
</div>