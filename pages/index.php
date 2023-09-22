<?php
require_once "./components/header.php";
require_once "./components/navbar.php";
?>
<div class="app">
	<p>Welcome to World Best Star! If you are new to this site, Please read <a href="">How to use</a>.</p>
	<h2>New charts</h2>
	<div class="charts-container">
<?php
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
echo getLevelCard($srl);
?>
	</div>
</div>
<?php
require_once "./components/footer.php";
?>
