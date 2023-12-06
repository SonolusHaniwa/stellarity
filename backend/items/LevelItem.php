<?php
class LevelItem {
	public $name = "";
	public $version = 1;
	public $rating = 5;
	public $title = "";
	public $artists = "";
	public $author = "";
	public $engine = [];
	public $useSkin = [];
	public $useBackground = [];
	public $useEffect = [];
	public $useParticle = [];
	public $cover = [];
	public $bgm = [];
	public $preview = [];
	public $data = [];
	public $description = "";
	
	public function __construct($name, $rating, $title, $artists, $author, $engine, $useSkin, $useBackground, $useEffect, $useParticle, $cover, $bgm, $preview, $data, $description) {
		$this->name = $name;
		$this->rating = $rating;
		$this->title = $title;
		$this->artists = $artists;
		$this->author = $author;
		$this->engine = $engine;
		$this->useSkin = $useSkin;
		$this->useBackground = $useBackground;
		$this->useEffect = $useEffect;
		$this->useParticle = $useParticle;
		$this->cover = $cover;
		$this->bgm = $bgm;
		$this->preview = $preview;
		$this->data = $data;
		$this->description = $description;
	}

/*	public function __construct($obj) {
		$this->name = $obj["name"];

	}*/
};

function getLevelData($obj) {
	global $engines, $SRLType;
	return new LevelItem(
		$obj["name"], $obj["isOliver"] == true ? 30 + $obj["level"] : $obj["level"], $obj["title"], $obj["composer"] . " / " . $obj["artists"], $obj["author"],
		$engines[0], new UseItem(true), new UseItem(false, getBackgroundData($obj)), new UseItem(true), new UseItem(true),
		new SRL($SRLType->LevelCover, "/data/" . $obj["coverHash"], $obj["coverHash"]),
		new SRL($SRLType->LevelBgm, "/data/" . $obj["musicHash"], $obj["musicHash"]),
		new SRL($SRLType->LevelPreview, "/data/" . $obj["musicHash"], $obj["musicHash"]),
		new SRL($SRLType->LevelData, "/data/" . $obj["dataHash"], $obj["dataHash"]), $obj["description"]
	);
}
?>
