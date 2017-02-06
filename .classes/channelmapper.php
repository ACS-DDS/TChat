<?php
class ChannelMapper{
	protected $fichier;

	public function __construct(){}

	public function createChannel($name){
		$n = trim($name);
		if($n != "null") : 
			var_dump($n);
			if($n != "") : 
				var_dump($n);
				if(!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $n . ".csv")) : 
					var_dump($n);
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
}