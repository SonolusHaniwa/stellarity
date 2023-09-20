<?php
require_once "./components/header.php";
require_once "./components/navbar.php";
$srl = new LevelItem(
	"wbs-hajakcyrbsozhc",
	5, 
	"Alice Blue", 
	"夏色花梨", 
	"114514#LittleYang0531", 
	[], 
	new UseItem(true),
	new UseItem(true),
	new UseItem(true),
	new UseItem(true),
	new SRL($SRLType->LevelCover, "", ""), 
	new SRL($SRLType->LevelBgm, "", ""), 
	new SRL($SRLType->LevelPreview, "", ""),
	new SRL($SRLType->LevelData, "", "")
);
/*$srl = new SkinItem(
	"wbs-default",
	"Sirius",
	"World Dai Star: Dream's Stellarium",
	"LittleYang0531",
	new SRL($SRLType.SkinThumbnail, "", ""),
	new SRL($SRLType.SkinData, "", ""),
	new SRL($SRLType.SkinTexture, "", "")
);*/
print_r(json_encode($srl, JSON_UNESCAPED_UNICODE));
require_once "./components/footer.php";
?>
