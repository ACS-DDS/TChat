<?php

class User {
	protected $nom;
	protected $prenom;
	protected $passw;
	protected $mail;
	protected $image;
	protected $pseudo;
	protected $status;

	public function __construct($array) {
		$this->nom = $array[0];
		$this->prenom = $array[1];
		$this->passw = $array[2];
		$this->mail = $array[3];
		$this->image = $array[4];
		$this->pseudo = $array[5];
		$this->status = $array[6];
	}

	public function toArray() {
		return array($this->nom, $this->pseudo, $this->status);
	}

	public function __toString() {
		ob_start();
		require(".data/tpl/users.tpl");
		return ob_get_clean();
	}
}
