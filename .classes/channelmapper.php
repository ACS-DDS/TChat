<?php
class ChannelMapper{
	protected $fichier;

	public function __construct(){}

	public function createChannel($name){
		if($name != "null" && !empty($name)){
			if(!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $name . ".csv")){
				touch($this->fichier);
			}
		}
	}

	public function deleteChannel($name){
		if($name != "null"){
			unlink(__DIR__ . "/../.data/db/channels/" . $name . ".csv");
		}
	}
}