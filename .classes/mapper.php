<?php

require_once(".classes/message.php");
require_once(".classes/user.php");

class Mapper{
	private $login;

	public function __construct(){
		//
	}

	public function addMessages($obj){
		/*echo "</br> ---- </br>";
		echo "Mapper::addMessages($.obj) : ";
		var_dump($obj);
		echo "</br> ---- </br>";*/

		$file = fopen(".data/db/chat.csv","a");
		fputcsv($file,$obj->toArray(),"|");
		fclose($file);
	}

	public function getMessages(){
		$file = fopen(".data/db/chat.csv","r");

		while($list = fgetcsv($file,0,"|")){
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

	public function getMembers(){
		$file = fopen(".data/db/users.csv","r");

		while($list = fgetcsv($file,0)){
			$users[] = new User($list);

			/*echo "</br> ---- </br>";
			echo "Mapper::getMembers() (while) : ";
			var_dump($list);
			echo "</br> ---- </br>";*/
		}

		return $users;

		/*echo "</br> ---- </br>";
		echo "Mapper::getMembers() : ";
		var_dump($users);
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
		$file = fopen(".data/db/users.csv","r");
		$file_temp = fopen(".data/db/users_temp.csv","w");

		while(false !== ($data = fgetcsv($file))){
			if($data[0] == $pseudo){
				$data[3] = "logged-out";
			}
			fputcsv($file_temp,$data);
		}

		fclose($file);
		fclose($file_temp);
		rename(".data/db/users_temp.csv",".data/db/users.csv");
	}

	public function login($pseudo){
		$file = fopen(".data/db/users.csv","r");
		$file_temp = fopen(".data/db/users_temp.csv","w");

		while(false !== ($data = fgetcsv($file))){
			if($data[0] == $pseudo){
				var_dump($data[0]);
				var_dump($pseudo);
				var_dump($data);
				$data[3] = "logged";
			}
			fputcsv($file_temp,$data);
		}

		fclose($file);
		fclose($file_temp);
		rename(".data/db/users_temp.csv",".data/db/users.csv");
	}
}