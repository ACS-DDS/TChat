<li class="<?=$this->status;?>">
	<a id="pm-<?=$this->pseudo;?>" href="#" onclick="soon();"><?=$this->pseudo;?></a>
<?php if ($_SESSION["username"] == "PERROT Corentin") : ?>
	<input type="button" id="suppr" name="<?=$this->pseudo;?>" onclick="deleteUser(this.name);" value="✖">
<?php endif;?>
</li>