<?php

require_once(".classes/user.php");

class UserMapper {
	protected $file;
	protected $file_temp;

	public function __construct() {
		$this->file = __DIR__ . "/../.data/db/users.csv";
		$this->file_temp = __DIR__ . "/../.data/db/users_temp.csv";
	}

	public function getMembers() {
		$file = fopen($this->file, "r");

		while ($list = fgetcsv($file, 0)) {
			$users[] = new User($list);
		}

		return $users;
	}

	public function deleteUser($name) {
		$table = fopen($this->file, "r");
		$temp_table = fopen($this->file_temp, "w");

		while (($data = fgetcsv($table, 1000)) !== FALSE) {
			if ($data[5] == $name) {
				continue;
			}

			fputcsv($temp_table, $data);
		}

		fclose($table);
		fclose($temp_table);
		rename($this->file_temp, $this->file);
	}
}
