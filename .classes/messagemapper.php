<?php

require_once(".classes/message.php");

class MessageMapper{
	private $fichier;
	private $fichier_temp;
	
	public function __construct($channel = "general"){
		/*echo "</br> ---- </br>";
		echo 'MessageMapper::__construct($.channel = "general") : ';
		var_dump($obj);
		echo "</br> ---- </br>";*/
		$this->fichier_temp = __DIR__ . "/../.data/db/channels/" . $channel . "_temp.csv";

		if(!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $channel . ".csv")){
			touch($this->fichier);
		}
	}

	public function addMessage($obj){
		/*echo "</br> ---- </br>";
		echo "MessageMapper::addMessage($.obj) : ";
		var_dump($obj);
		echo "</br> ---- </br>";*/

		$file = fopen($this->fichier,"a");
		fputcsv($file,$obj->toArray());
		fclose($file);
	}

	public function getMessages(){
		/*echo "</br> ---- </br>";
		echo "MessageMapper::getMessages() : ";
		var_dump($obj);
		echo "</br> ---- </br>";*/

		$file = fopen($this->fichier,"r");

		while($list = fgetcsv($file,0)){
			$list["author"] = $list[0];
			$list["content"] = $list[1];
			$list["date"] = $list[2];

			$messages[] = new Message($list);

			/*echo "</br> ---- </br>";
			echo "Mapper::getMessages() (while) : ";
			var_dump($list);
			echo "</br> ---- </br>";*/
		}
		fclose($file);

		if(empty($messages)) : 
			return array(new Message(array("author" => "Admin","content" => "Ceci est le Message par défault","date" => "1485160479.8259")));
		else : 
			return $messages;
		endif;
	}

	public function deleteMessage($name){
		echo "</br> ---- </br>";
		echo "MessageMapper::deleteMessage($.name) : ";
		var_dump($name);
		echo "</br> ---- </br>";
		var_dump($this);
		echo "</br> ---- </br>";

		$table = fopen($this->fichier,"r");
		$temp_table = fopen($this->fichier_temp,"w");

		while(($data = fgetcsv($table,1000)) !== FALSE){
		    if($data[1] == $name){ // this is if you need the first column in a row
		        continue;
		    }
		    var_dump($data);
		    fputcsv($temp_table,$data);
		}
		fclose($table);
		fclose($temp_table);
		rename($this->fichier_temp,$this->fichier);
	}

	public function resetMessages(){
		$file = fopen($this->fichier,"w");
		fputcsv($file,"");
		fclose($file);

		/*echo "</br> ---- </br>";
		echo "Mapper::resetMessages() : ";
		var_dump($file);
		echo "</br> ---- </br>";*/
	}
}