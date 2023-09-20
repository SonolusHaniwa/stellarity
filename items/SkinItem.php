<?php
class SkinItem {
	public $name = "";
	public $version = 4;
	public $title = "";
	public $subtitle = "";
	public $author = "";
	public $thumbnail = [];
	public $data = [];
	public $texture = [];

	public function __construct($name, $title, $subtitle, $author, $thumbnail, $data, $texture) {
		$this->name = $name;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->author = $author;
		$this->thumbnail = $thumbnail;
		$this->data = $data;
		$this->texture = $texture;
	}
};
?>
