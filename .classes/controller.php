<?php

require_once(".classes/mapper.php");
require_once(".classes/message.php");

class Controller{
	protected $m;

	public function __construct(){
		/*echo "</br> ---- </br>";
		echo "Controller::__construct() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		$this->m = new Mapper();
	}

	public function register($nom){
		//
	}

	public function login($nom){
		/*echo "</br> ---- </br>";
		echo "Controller::login($.nom) : ";
		var_dump($nom);
		var_dump($this);
		echo "</br> ---- </br>";*/

		//$_SESSION["username"] = $nom;
		return $this->m->login($nom);
	}

	public function logged(){
		return $this->m->logged();
	}

	public function logout($pseudo){
		return $this->m->logout($pseudo);
	}

	public function getMessages(){
		/*echo "</br> ---- </br>";
		echo "Controller::getMessages() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->getMessages();
	}

	public function addMessages($array){
		/*echo "</br> ---- </br>";
		echo "Controller::addMessages($.array) : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->addMessages(new Message($array));
	}

	public function resetMessages(){
		/*echo "</br> ---- </br>";
		echo "Controller::resetMessages() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->resetMessages();
	}
}