<div id="message">
	<img src="https://d13yacurqjgara.cloudfront.net/users/49730/avatars/original/Logo.jpg" alt="Profile">

	<p class="author"><?=$this->author;?></p>
	<p class="content"><?=$this->message;?></p>
	<p class="time"><?=ucfirst(strftime("%A %e %B %Y à %k:%M:%S", $this->date));?></p>
<?php if ($_SESSION["username"] == "PERROT Corentin") : ?>
	<input type="button" name="<?=$this->message;?>" date="<?=$this->date;?>" id="clear" value="✕" onclick="deleteMessage(this.name,this.attributes[2].value);">
<?php endif;?>
</div>