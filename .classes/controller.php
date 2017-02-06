<?php

require_once(__DIR__ . "/usermapper.php");
require_once(__DIR__ . "/messagemapper.php");
require_once(__DIR__ . "/channelmapper.php");
require_once(__DIR__ . "/message.php");

class Controller{
	protected $message_mapper;
	protected $user_mapper;
	protected $channel_mapper;

	public function __construct($channel = "general"){
		$this->user_mapper    = new UserMapper();
		$this->message_mapper = new MessageMapper($channel);
		$this->channel_mapper = new ChannelMapper($channel);
	}

	private function isRegistered(){
		return isset($_SESSION["username"]);
	}

	////////////////////////////////////////////////////////////////////////////////

	public function register($nom){
		return $this->user_mapper->register($nom);
	}

	public function login($nom){
		return $this->user_mapper->login($nom);
	}

	public function logout($pseudo){
		return $this->user_mapper->logout($pseudo);
	}

	public function getMembers(){
		if(!$this->isRegistered()) return;

		return $this->user_mapper->getMembers();
	}

	public function deleteUser($name){
		if(!$this->isRegistered()) return;

		return $this->user_mapper->deleteUser($name);
	}

	////////////////////////////////////////////////////////////////////////////////

	public function changeChannel(){
		if(!$this->isRegistered()) return;

		return $this->message_mapper->getMessages();
	}

	public function createChannel($name){
		if(!$this->isRegistered()) return;

		return $this->channel_mapper->createChannel($name);
	}

	public function deleteChannel($name){
		return $this->channel_mapper->deleteChannel($name);
	}

	////////////////////////////////////////////////////////////////////////////////

	public function getMessages(){
		if(!$this->isRegistered()) return;

		return $this->message_mapper->getMessages();
	}

	public function addMessages($array){
		if(!$this->isRegistered()) return;

		return $this->message_mapper->addMessage(new Message($array));
	}

	public function resetMessages(){
		if(!$this->isRegistered()) return;

		return $this->message_mapper->resetMessages();
	}

	public function deleteMessage($a,$b){
		if(!$this->isRegistered()) return;

		return $this->message_mapper->deleteMessage($a,$b);
	}
}