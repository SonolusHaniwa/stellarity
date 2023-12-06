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
	public $description = "";

	public function __construct($name, $title, $subtitle, $author, $thumbnail, $data, $image, $configuration, $description) {
		$this->name = $name;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->author = $author;
		$this->thumbnail = $thumbnail;
		$this->data = $data;
		$this->image = $image;
		$this->configuration = $configuration;
		$this->description = $description;
	}

/*	public function __construct($obj) {
		global $backgroundData, $backgroundConfiguration;
		$this->name = $obj["name"];
		$this->title = $obj["title"];
		$this->subtitle = $obj["composer"] . " / " . $obj["artists"];
		$this->author = $obj["author"];
		$this->thumbnail = new SRL($SRLType->BackgroundThumbnail, "/data/" . $obj["coverHash"], $obj["coverHash"]);
		$this->data = $backgroundData;
		$this->image = new SRL($SRLType->BackgroundImage, "/data/" . $obj["backgroundHash"], $obj["backgroundHash"]);
		$this->configuration = $backgroundConfiguration;
	}*/
};

function getBackgroundData($obj) {
	global $backgroundData, $backgroundConfiguration, $SRLType;
	return new BackgroundItem(
		$obj["name"], $obj["title"], $obj["composer"] . " / " . $obj["artists"], $obj["author"],
		new SRL($SRLType->BackgroundThumbnail, "/data/" . $obj["coverHash"], $obj["coverHash"]), $backgroundData,
		new SRL($SRLType->BackgroundImage, "/data/" . $obj["backgroundHash"], $obj["backgroundHash"]), $backgroundConfiguration, $obj["description"]
	);		
}
?>
