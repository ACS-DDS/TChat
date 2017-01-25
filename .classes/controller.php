<?php

require_once(".classes/usermapper.php");
require_once(".classes/messagemapper.php");
require_once(".classes/channelmapper.php");
require_once(".classes/message.php");

class Controller{
	protected $message_mapper;
	protected $user_mapper;
	protected $channel_mapper;

	public function __construct($channel = "general"){
		/*echo "</br> ---- </br>";
		echo "Controller::__construct() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		$this->user_mapper    = new UserMapper();
		$this->message_mapper = new MessageMapper($channel);
		$this->channel_mapper = new ChannelMapper($channel);
	}

	private function isRegistered(){
		return isset($_SESSION["username"]);
	}

	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////

	public function register($nom){
		/*echo "</br> ---- </br>";
		echo "Controller::register($.nom) : ";
		var_dump($nom);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->user_mapper->register($nom);
	}

	public function login($nom){
		/*echo "</br> ---- </br>";
		echo "Controller::login($.nom) : ";
		var_dump($nom);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->user_mapper->login($nom);
	}

	public function logout($pseudo){
		/*echo "</br> ---- </br>";
		echo "Controller::logout($.nom) : ";
		var_dump($pseudo);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->user_mapper->logout($pseudo);
	}

	public function getMembers(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMembers() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->user_mapper->getMembers();
	}

	public function deleteUser($name){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMembers() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->user_mapper->deleteUser($name);
	}

	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////

	public function changeChannel(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMembers() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->message_mapper->getMessages();
	}

	public function createChannel($name){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::createChannel() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->channel_mapper->createChannel($name);
	}

	public function deleteChannel($name){
		/*echo "</br> ---- </br>";
		echo "Controller::deleteChannel($.name) : ";
		var_dump($name);
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->channel_mapper->deleteChannel($name);
	}

	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////

	public function getMessages(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::getMessages() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->message_mapper->getMessages();
	}

	public function addMessages($array){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::addMessages($.array) : ";
		var_dump($this);
		echo "</br> ---- </br>";
		var_dump($array);
		echo "</br> ---- </br>";*/

		return $this->message_mapper->addMessage(new Message($array));
	}

	public function resetMessages(){
		if(!$this->isRegistered()) return;
		/*echo "</br> ---- </br>";
		echo "Controller::resetMessages() : ";
		var_dump($this);
		echo "</br> ---- </br>";*/

		return $this->message_mapper->resetMessages();
	}
}