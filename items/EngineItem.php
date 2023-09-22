<?php
class EngineItem {
	public $name = "";
	public $version = 10;
	public $title = "";
	public $subtitle = "";
	public $author = "";
	public $skin = [];
	public $background = [];
	public $effect = [];
	public $particle = [];
	public $thumbnail = [];
	public $playData = [];
	public $previewData = [];
	public $tutorialData = [];
	public $rom = [];
	public $configuration = [];
	public $description = "";

	public function __construct($name, $title, $subtitle, $author, $skin, $background, $effect, $particle, $thumbnail, $playData, $previewData, $tutorialData, $rom, $configuration, $description) {
		$this->name = $name;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->author = $author;
		$this->skin = $skin;
		$this->background = $background;
		$this->effect = $effect;
		$this->particle = $particle;
		$this->thumbnail = $thumbnail;
		$this->playData = $playData;
		$this->previewData = $previewData;
		$this->tutorialData = $tutorialData;
		$this->rom = $rom;
		$this->configuration = $configuration;
		$this->description = $description;
	}
};
?>
