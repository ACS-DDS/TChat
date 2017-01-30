<li class="<?=$this->status;?>">
	<a id="pm-<?=$this->pseudo;?>" href="#"><?=$this->pseudo;?></a>
<?php if($_SESSION["username"] == "Corentin") : ?>
	<input type="button" id="suppr" name="<?=$this->pseudo;?>" onclick="deleteUser(this.name);" value="✖">
<?php endif;?>
</li>