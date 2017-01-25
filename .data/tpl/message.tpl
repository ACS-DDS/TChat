<div id="message">
	<!--?="</br> ---- </br>";?-->
	<!--?="message.tpl : ";?-->
	<!--?=var_dump($this);?-->
	<!--?="</br> ---- </br>";?-->

	<img src="https://d13yacurqjgara.cloudfront.net/users/49730/avatars/original/Logo.jpg?1312213943" alt="">
	<p class="author"><?=$this->author;?> (<!--?=$this->pseudo;?-->)</p>
	<p class="content"><?=$this->message;?></p>
	<p class="time"><?=ucfirst(strftime("%A %e %B %Y à %k:%M:%S",$this->date));?></p>
	<input type="button" name="clear" id="clear" value="✕">
</div>