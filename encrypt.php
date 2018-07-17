<?php
if (isset($_GET["pass"])) : 
	echo sha1(md5("raton" . $_GET["pass"] . "laveur"));
endif;
?>