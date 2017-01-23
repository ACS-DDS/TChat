<?php
class User{
	protected $name;
	protected $pseudo;

	public function __construct($array){
		/*echo "</br> ---- </br>";
		echo "DirectMessage::__construct($.array) : ";
		var_dump($array);
		var_dump($this);
		echo "</br> ---- </br>";*/

		////////////////////////////

		$this->name   = $array[0];
		$this->pseudo = $array[2];
		$this->status = $array[3];
	}

	public function toArray(){
		/*echo "</br> ---- </br>";
		echo "DirectMessage::toArray() : ";
		var_dump(array("author" => $this->author,"content" => $this->message,"date" => $this->date));
		echo "</br> ---- </br>";
		var_dump($this);
		echo "</br> ---- </br>";
		var_dump($this->author);
		echo "</br> ---- </br>";
		var_dump($this->message);
		echo "</br> ---- </br>";
		var_dump($this->date);
		echo "</br> ---- </br>";*/

		return array($this->name,$this->pseudo,$this->status);
	}

	public function html(){
		/*echo "</br> ---- </br>";
		echo "DirectMessage::html() : ";
		var_dump($this);
		echo "</br> ---- </br>";
		var_dump($this->author);
		echo "</br> ---- </br>";
		var_dump($this->message);
		echo "</br> ---- </br>";
		var_dump($this->date);
		echo "</br> ---- </br>";*/

		ob_start();
		require(".data/tpl/users.tpl");
		return ob_get_clean();
	}

	public function __toString(){
		/*echo "</br> ---- </br>";
		echo "DirectMessage::__toString() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->html();
	}
}