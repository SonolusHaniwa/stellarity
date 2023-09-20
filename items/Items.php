<?php
class ItemList {
	public $pageCount = 0;
	public $items = [];
	public $search = [];

	public function __construct($items = [], $search = []) {
		$this->pageCount = intval((count($items) - 1) / 20) + 1;
		$this->items = $items;
		$this->search = $search;
	}

	public function append($item) {
		$this->items[] = $item;
		$this->pageCount = intval((count($items) - 1) / 20) + 1;
	}
};

class ItemDetails {
	public $item = [];
	public $description = "";
	public $recommended = [];

	public function __construct($item, $description = "", $recommended = []) {
		$this->item = $item;
		$this->description = $description;
		$this->recommended = $recommended;
	}

	public function appendRecommended($item) {
		$this->recommended[] = $item;
	}
};

class UseItem {
	public $useDefault = true;
	public $item = [];

	public function __construct($useDefault, $item = []) {
		$this->useDefault = $useDefault;
		$this->item = $item;
	}
};
?>
