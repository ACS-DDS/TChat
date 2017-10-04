<?php

class Message {
	protected $author;
	protected $message;
	protected $date;
	protected $pseudo;

	public function __construct($array){
		$this->author = $array["author"];
		$this->message = $array["content"];
		$this->date = $array["date"];
	}

	/**
	 * toArray function.
	 * 
	 * @return array of the message
	 */
	public function toArray() {
		return array(
			"author" => $this->author,
			"content" => $this->message,
			"date" => $this->date
		);
	}

	/**
	 * html function.
	 * 
	 * @return html formated
	 */
	public function html() {
		ob_start();
		require(__DIR__ . "/../.data/tpl/message.tpl");
		return ob_get_clean();
	}

	/**
	 * __toString function.
	 * 
	 * @return html function
	 */
	public function __toString() {
		return $this->html();
	}
}
