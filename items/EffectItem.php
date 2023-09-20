<?php
class EffectItem {
	public $name = "";
	public $version = 5;
	public $title = "";
	public $subtitle = "";
	public $author = "";
	public $thumbnail = [];
	public $data = [];
	public $audio = [];

	public function __construct($name, $title, $subtitle, $author, $thumbnail, $data, $audio) {
		$this->name = $name;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->author = $author;
		$this->thumbnail = $thumbnail;
		$this->data = $data;
		$this->audio = $audio;
	}
};
?>
