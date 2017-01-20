<?php

require_once(".classes/message.php");
require_once(".classes/logged.php");

class Mapper{

	public function __construct(){
		//
	}

	public function addMessages($obj){
		/*echo "</br> ---- </br>";
		echo "Mapper::addMessages($.obj) : ";
		var_dump($obj);
		echo "</br> ---- </br>";*/

		$file = fopen(".data/db/chat.csv","a");
		fputcsv($file,$obj->toArray(),";");
		fclose($file);
	}

	public function getMessages(){
		$file = fopen(".data/db/chat.csv","r");

		while($list = fgetcsv($file,0,";")){
			$list["author"] = $list[0];
			$list["content"] = $list[1];
			$list["date"] = $list[2];

			$messages[] = new Message($list);

			/*echo "</br> ---- </br>";
			echo "Mapper::getMessages() (while) : ";
			var_dump($list);
			echo "</br> ---- </br>";*/
		}

		return $messages;

		/*echo "</br> ---- </br>";
		echo "Mapper::getMessages() : ";
		var_dump($messages);
		echo "</br> ---- </br>";*/
	}

	public function resetMessages(){
		$file = fopen(".data/db/chat.csv","w");
		fputcsv($file,"");
		fclose($file);

		/*echo "</br> ---- </br>";
		echo "Mapper::resetMessages() : ";
		var_dump($file);
		echo "</br> ---- </br>";*/
	}

	public function logout($pseudo){
		$file = fopen(".data/db/logged.csv","r");
		$file_temp = fopen(".data/db/logged_temp.csv","w");
		echo "debut";
		var_dump($pseudo);

		while(($data = fgetcsv($file,1000,";")) !== FALSE){
			if(reset($data) == $pseudo){ // this is if you need the first column in a row
				continue;
			}
			fputcsv($file_temp,$data,";");
		}
		fclose($file);
		fclose($file_temp);
		rename(".data/db/logged_temp.csv",".data/db/logged.csv");
	}

	public function login($pseudo){
		$file = fopen(".data/db/logged.csv","a");
		fputcsv($file,array($pseudo,"yes"),";");
		fclose($file);
	}

	public function logged(){
		$file = fopen(".data/db/logged.csv","r");

		while($list = fgetcsv($file,0,";")){
			$users[] = new Logged($list);
		}

		return $users;
	}
}