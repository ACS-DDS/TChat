<?php

require_once(".classes/user.php");

class UserMapper{
	protected $file;
	protected $file_temp;
	
	public function __construct(){
		$this->file = __DIR__ . "/../.data/db/users.csv";
		$this->file_temp = __DIR__ . "/../.data/db/users_temp.csv";
	}

	public function register($nom){
		return "ok";
	}

	public function login($pseudo){
		$file = fopen($this->file,"r");
		$file_temp = fopen($this->file_temp,"w");

		while(false !== ($data = fgetcsv($file))){
			if($data[0] . " " . $data[1] == $pseudo){
				$data[6] = "logged";
			}
			fputcsv($file_temp,$data);
		}

		fclose($file);
		fclose($file_temp);
		rename($this->file_temp,$this->file);
	}

	public function logout($pseudo){
		$file = fopen($this->file,"r");
		$file_temp = fopen($this->file_temp,"w");

		while(false !== ($data = fgetcsv($file))){
			if($data[0] . " " . $data[1] == $pseudo){
				$data[6] = "logged-out";
			}
			fputcsv($file_temp,$data);
		}

		fclose($file);
		fclose($file_temp);
		rename($this->file_temp,$this->file);

		session_destroy();
		header("Location: http://corentinp.dijon.codeur.online/TChat/login");
	}

	public function getMembers(){
		$file = fopen($this->file,"r");

		while($list = fgetcsv($file,0)){
			$users[] = new User($list);
		}

		return $users;
	}

	public function deleteUser($name){
		$table = fopen($this->file,"r");
		$temp_table = fopen($this->file_temp,"w");

		while(($data = fgetcsv($table,1000)) !== FALSE){
			if($data[5] == $name){
				continue;
			}

			fputcsv($temp_table,$data);
		}

		fclose($table);
		fclose($temp_table);
		rename($this->file_temp,$this->file);
	}
}