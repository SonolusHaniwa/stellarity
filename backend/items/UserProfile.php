<?php
class UserProfile {
	public $id = "";
	public $handle = "";
	public $name = "";
	public $avatarForegroundColor = "";
	public $avatarBackgroundColor = "";
	public $aboutMe = "";
	public $socialLinks = [];
	public $favorites = [];

	public function __construct($id, $handle, $name, $avatarForegroundColor, $avatarBackgroundColor, $aboutMe, $socialLinks, $favorites) {
		$this->id = $id;
		$this->handle = $handle;
		$this->name = $name;
		$this->avatarForegroundColor = $avatarForegroundColor;
		$this->avatarBackgroundColor = $avatarBackgroundColor;
		$this->aboutMe = $aboutMe;
		$this->socialLinks = $socialLinks;
		$this->favorites = $favorites;
	}
}
?>
