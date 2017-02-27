<?php foreach($channel as $id => $b) : ?>
<li>
	<a id="ch-<?=$id;?>" name="<?=$b;?>" href="#" onclick="channel=this.name;changeChannel(this.name)"><?=$b;?></a>
<?php if($_SESSION["username"] == "PERROT Corentin") : ?>
	<input type="button" id="suppr" name="<?=$b;?>" onclick="deleteChannel(this.name)" value="✖">
<?php endif;?>
</li>
<?php endforeach;?>