<?php

require_once(__DIR__ . "/usermapper.php");
require_once(__DIR__ . "/authmapper.php");
require_once(__DIR__ . "/messagemapper.php");
require_once(__DIR__ . "/channelmapper.php");
require_once(__DIR__ . "/message.php");

class Controller {
	protected $user_mapper;
	protected $auth_mapper;
	protected $message_mapper;
	protected $channel_mapper;

	public function __construct($channel = "general") {
		$this->user_mapper = new UserMapper();
		$this->auth_mapper = new AuthMapper();
		$this->message_mapper = new MessageMapper($channel);
		$this->channel_mapper = new ChannelMapper($channel);
	}

	private function isLogged() {
		return isset($_SESSION["username"]);
	}

	////////////////////////////////////////////////////////////////////////////////

	public function register($nom, $prenom, $password, $mail, $img, $pseudo) {
		return $this->auth_mapper->register($nom, $prenom, $password, $mail, $img, $pseudo);
	}

	public function login($nom) {
		return $this->auth_mapper->login($nom);
	}

	public function logout($pseudo) {
		if (!$this->isLogged()) return;

		return $this->auth_mapper->logout($pseudo);
	}

	public function getMembers() {
		if (!$this->isLogged()) return;

		return $this->user_mapper->getMembers();
	}

	public function deleteUser($name) {
		if (!$this->isLogged()) return;

		return $this->user_mapper->deleteUser($name);
	}

	////////////////////////////////////////////////////////////////////////////////

	public function getChannels() {
		if (!$this->isLogged()) return;

		return $this->channel_mapper->getChannels();
	}

	public function changeChannel() {
		if (!$this->isLogged()) return;

		return $this->message_mapper->getMessages();
	}

	public function createChannel($name) {
		if (!$this->isLogged()) return;

		return $this->channel_mapper->createChannel($name);
	}

	public function deleteChannel($name) {
		if (!$this->isLogged()) return;

		return $this->channel_mapper->deleteChannel($name);
	}

	////////////////////////////////////////////////////////////////////////////////

	public function getMessages() {
		if (!$this->isLogged()) return;

		return $this->message_mapper->getMessages();
	}

	public function addMessages($array) {
		if (!$this->isLogged()) return;

		return $this->message_mapper->addMessage(new Message($array));
	}

	public function deleteMessage($a, $b) {
		if (!$this->isLogged()) return;

		return $this->message_mapper->deleteMessage($a, $b);
	}

	public function resetMessages() {
		if (!$this->isLogged()) return;

		return $this->message_mapper->resetMessages();
	}
}
