<?php

require_once(".classes/message.php");

class MessageMapper {
	private $fichier;
	private $fichier_temp;
	
	public function __construct($channel = "general") {
		$this->fichier_temp = __DIR__ . "/../.data/db/channels/" . $channel . "_temp.csv";

		if (!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $channel . ".csv")) {
			$this->fichier = __DIR__ . "/../.data/db/channels/general.csv";
		}
	}

	/**
	 * addMessage function.
	 * 
	 * @param $message object
	 * @return void
	 */
	public function addMessage($message) {
		$file = fopen($this->fichier, "a");

		fputcsv($file, $message->toArray());

		fclose($file);
	}

	/**
	 * getMessages function.
	 * 
	 * @return Array of Message or boolean if empty
	 */
	public function getMessages(){
		$file = fopen($this->fichier, "r");

		while ($list = fgetcsv($file, 0)) {
			$list["author"] = $list[0];
			$list["content"] = $list[1];
			$list["date"] = $list[2];

			$messages[] = new Message($list);
		}

		fclose($file);

		if (empty($messages)) : 
			return false;
		else : 
			return $messages;
		endif;
	}

	/**
	 * deleteMessage function.
	 * 
	 * @param $name name of the author of the message
	 * @param $time time of the message
	 * 
	 * @return void
	 */
	public function deleteMessage($name, $time) {
		$table = fopen($this->fichier, "r");
		$temp_table = fopen($this->fichier_temp, "w");

		while (($data = fgetcsv($table,1000)) !== FALSE) {
			if ($data[1] == $name && $data[2] == $time) {
				continue;
			}

			fputcsv($temp_table, $data);
		}

		fclose($table);
		fclose($temp_table);
		rename($this->fichier_temp, $this->fichier);
	}

	/**
	 * resetMessages function.
	 * 
	 * @return void
	 */
	public function resetMessages() {
		$file = fopen($this->fichier, "w");

		ftruncate($file, 0);

		fclose($file);
	}
}
