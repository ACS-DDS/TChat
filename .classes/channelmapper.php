<?php
class ChannelMapper{
	protected $fichier;
	
	public function __construct(){}

	public function createChannel($name){
		/*echo "</br> ---- </br>";
		echo "MessageMapper::createChannel($.name) : ";
		var_dump($name);
		echo "</br> ---- </br>";
		var_dump($this);
		echo "</br> ---- </br>";*/

		if($name != "null" && !empty($name)){
			if(!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $name . ".csv")){
				touch($this->fichier);
				/*var_dump($this->fichier);
				echo "</br> ---- </br>";*/
			}
		}
	}

	public function deleteChannel($name){
		if($name != "null"){
			/*echo "</br> ---- </br>";
			echo "MessageMapper::deleteChannel($.name) (if) : ";
			var_dump(unlink($fichier = __DIR__ . "/../.data/db/channels/" . $name . ".csv"));
			echo "</br> ---- </br>";*/

			unlink(__DIR__ . "/../.data/db/channels/" . $name . ".csv");
		}

		/*echo "</br> ---- </br>";
		echo "MessageMapper::deleteChannel($.name) : ";
		var_dump($name);
		var_dump($this);
		echo "</br> ---- </br>";*/
	}
}