<?php

require_once(".classes/mapper.php");
require_once(".classes/message.php");
require_once(".classes/messagemapper.php");

class Controller{
	protected $m;
	protected $mapper;

	public function __construct($channel = "general"){
		/*echo "</br> ---- </br>";
		echo "Controller::__construct() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		$this->m = new Mapper();
		$this->mapper = new MessageMapper($channel);
	}

	private function isRegistered(){
		return isset($_SESSION["username"]);
	}

	public function register($nom){
		/*echo "</br> ---- </br>";
		echo "Controller::register($.nom) : ";
		var_dump($nom);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->register($nom);
	}

	public function login($nom){
		/*echo "</br> ---- </br>";
		echo "Controller::login($.nom) : ";
		var_dump($nom);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->login($nom);
	}

	public function logout($pseudo){
		/*echo "</br> ---- </br>";
		echo "Controller::logout($.nom) : ";
		var_dump($pseudo);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->logout($pseudo);
	}

	public function getMembers(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMembers() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->m->getMembers();
	}

	public function changeChannel(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMembers() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->mapper->getMessages();
	}

	public function createChannel($name){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::createChannel() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->mapper->createChannel($name);
	}

	public function getMessages(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMessages() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->mapper->getMessages();
	}

	public function addMessages($array){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::addMessages($.array) : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->mapper->addMessage(new Message($array));
	}

	public function resetMessages(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::resetMessages() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->mapper->resetMessages();
	}
}