<?php
class BackgroundItem {
	public $name = "";
	public $version = 2;
	public $title = "";
	public $subtitle = "";
	public $author = "";
	public $thumbnail = [];
	public $data = [];
	public $image = [];
	public $configuration = [];

	public function __construct($name, $title, $subtitle, $author, $thumbnail, $data, $image, $configuration) {
		$this->name = $name;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->author = $author;
		$this->thumbnail = $thumbnail;
		$this->data = $data;
		$this->image = $image;
		$this->configuration = $configuration;
	}
};
?>
