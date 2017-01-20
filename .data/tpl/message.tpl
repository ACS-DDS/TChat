<div id="message">
	<!--?="</br> ---- </br>";?-->
	<!--?="message.tpl : ";?-->
	<!--?=var_dump($this);?-->
	<!--?="</br> ---- </br>";?-->

	<p class="author"><?=$this->author;?></p>
	<p class="content"><?=$this->message;?></p>
	<p class="date"><?=ucfirst(strftime("%A %e %B %Y à %k:%M:%S",$this->date));?></p>
</div>