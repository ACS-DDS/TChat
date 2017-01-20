<?php
class Logged{
	protected $pseudo;

	public function __construct($array){
		$this->pseudo  = $array[0];
	}

	public function toArray(){
		return array($this->pseudo);
	}

	public function html(){
		ob_start();
		require(".data/tpl/logged.tpl");
		return ob_get_clean();
	}

	public function __toString(){
		return $this->html();
	}
}