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
	
	public function __construct($name, $rating, $title, $artists, $author, $engine, $useSkin, $useBackground, $useEffect, $useParticle, $cover, $bgm, $preview, $data) {
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
	}
};
?>
