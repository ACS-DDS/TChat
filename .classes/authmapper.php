<?php

class AuthMapper {
	protected $file;
	protected $file_temp;

	public function __construct() {
		$this->file = __DIR__ . "/../.data/db/users.csv";
		$this->file_temp = __DIR__ . "/../.data/db/users_temp.csv";
	}

	public function register($nom, $prenom, $password, $mail, $img, $pseudo) {
		return true; // TODO
	}

	public function login($pseudo) {
		$file = fopen($this->file, "r");
		$file_temp = fopen($this->file_temp, "w");

		while (false !== ($data = fgetcsv($file))) {
			if ($data[0] . " " . $data[1] == $pseudo) {
				$data[6] = "logged";
			}

			fputcsv($file_temp, $data);
		}

		fclose($file);
		fclose($file_temp);
		rename($this->file_temp, $this->file);
	}

	public function logout($pseudo) {
		$file = fopen($this->file, "r");
		$file_temp = fopen($this->file_temp, "w");

		while (false !== ($data = fgetcsv($file))) {
			if ($data[0] . " " . $data[1] == $pseudo) {
				$data[6] = "logged-out";
			}

			fputcsv($file_temp, $data);
		}

		fclose($file);
		fclose($file_temp);
		rename($this->file_temp, $this->file);

		session_destroy();
		header("Location: ./login");
	}
}
