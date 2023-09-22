<?php
class ParticleItem {
	public $name = "";
	public $version = 2;
	public $title = "";
	public $subtitle = "";
	public $author = "";
	public $thumbnail = [];
	public $data = [];
	public $texture = [];
	public $description = "";

	public function __construct($name, $title, $subtitle, $author, $thumbnail, $data, $texture, $description) {
		$this->name = $name;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->author = $author;
		$this->thumbnail = $thumbnail;
		$this->data = $data;
		$this->texture = $texture;
		$this->description = $description;
	}
};
?>
