<?php

class ChannelMapper {
	protected $fichier;

	public function createChannel($name) {
		if ($name != "null" || $name != "general") : 
			if (!file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $name . ".csv")) : 
				touch($this->fichier);
			endif;
		endif;
	}

	public function deleteChannel($name) {
		if ($name != "null" || $name != "general") : 
			if (file_exists($this->fichier = __DIR__ . "/../.data/db/channels/" . $name . ".csv")) : 
				unlink($this->fichier);
			endif;
		endif;
	}

	public function getChannels() {
		$channel = str_replace(array(".csv"), "", array_diff(scandir(".data/db/channels"), array(".", "..")));

		ob_start();
		require(".data/tpl/channels.tpl");
		return ob_get_clean();
	}

	public function __toString() {
		return $this->getChannels();
	}
}
