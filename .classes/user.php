<?php
class User{
	protected $name;
	protected $pseudo;

	public function __construct($array){
		$this->name   = $array[0];
		$this->pseudo = $array[2];
		$this->status = $array[3];
	}

	public function toArray(){
		return array($this->name,$this->pseudo,$this->status);
	}

	public function html(){
		ob_start();
		require(".data/tpl/users.tpl");
		return ob_get_clean();
	}

	public function __toString(){
		return $this->html();
	}
}