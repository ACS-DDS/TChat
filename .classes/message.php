<?php
class Message{
	protected $author;
	protected $message;
	protected $date;
	protected $pseudo;

	public function __construct($array){
		/*echo "</br> ---- </br>";
		echo "Message::__construct($.array) : ";
		var_dump($array);
		var_dump($this);
		echo "</br> ---- </br>";*/

		$this->author  = $array["author"];
		$this->message = $array["content"];
		$this->date    = $array["date"];
	}

	public function toArray(){
		/*echo "</br> ---- </br>";
		echo "Message::toArray() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return array("author" => $this->author,"content" => $this->message,"date" => $this->date);
	}

	public function html(){
		/*echo "</br> ---- </br>";
		echo "Message::html() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		ob_start();
		require(".data/tpl/message.tpl");
		return ob_get_clean();
	}

	public function __toString(){
		/*echo "</br> ---- </br>";
		echo "Message::__toString() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->html();
	}
}