<?php
class ChannelMapper{
	protected $fichier;

	public function __construct(){}

	public function createChannel($name){
		$n = trim($name);
		if($n != "null") : 
			if($n != "") : 
				if(!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $n . ".csv")) : 
					touch($this->fichier);
				endif;
			endif;
		endif;
	}

	public function deleteChannel($name){
		if($name != "null") : 
			if($name != "general") : 
				unlink(__DIR__ . "/../.data/db/channels/" . $name . ".csv");
			endif;
		endif;
	}

	public function getChannels(){
		$channel = str_replace(array(".csv"),"",array_diff(scandir(".data/db/channels"),array(".","..")));

		ob_start();
		require(".data/tpl/channels.tpl");
		return ob_get_clean();
	}

	public function __toString(){
		return $this->getChannels();
	}
}