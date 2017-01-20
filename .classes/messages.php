<?php
class Messages{
	protected $messages = [];
	protected $author;
	protected $message;
	protected $date;

	public function __construct($array){
		$this->messages[] = array(
			$this->author  = $array["author"],
			$this->message = $array["content"],
			$this->date    = (string)time()
		);
	}

	public function addMessages($array){
		$this->messages[] = array(
			$this->author  = $array["author"],
			$this->message = $array["content"],
			$this->date    = (string)time()
		);

		$file = fopen(".data/chat.csv","a");
		fputcsv($file,$array,";");
		fclose($file);
	}

	public function getMessages(){
		$file = fopen(".data/chat.csv","r");

		while($list = fgetcsv($file,0,";")){
			$messages[] = $list;
		}

		return $messages;
	}

	public function reset(){
		$file = fopen(".data/chat.csv","w");
		fputcsv($file,"");
		fclose($file);
	}

	public function html(){
		ob_start();
		require ".data/message.tpl";
		return ob_get_clean();
	}

	public function __toString(){
		return $this->html;
	}
}