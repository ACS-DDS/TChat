<?php

require_once(".classes/user.php");

class UserMapper{
	
	public function __construct(){}

	public function register($nom){
		return "ok";
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

		session_destroy();
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
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

	public function deleteUser($name){
		$this->fichier = __DIR__ . "/../.data/db/users.csv";
		$this->fichier_temp = __DIR__ . "/../.data/db/users_temp.csv";

		echo "</br> ---- </br>";
		echo "MessageMapper::deleteUser($.name) : ";
		var_dump($name);
		echo "</br> ---- </br>";
		var_dump($this);
		echo "</br> ---- </br>";

		$table = fopen($this->fichier,"r");
		$temp_table = fopen($this->fichier_temp,"w");

		while(($data = fgetcsv($table,1000)) !== FALSE){
		    if($data[2] == $name){ // this is if you need the first column in a row
		        continue;
		    }
		    var_dump($data);
		    fputcsv($temp_table,$data);
		}
		fclose($table);
		fclose($temp_table);
		rename($this->fichier_temp,$this->fichier);
	}
}