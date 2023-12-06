<?php
// MySQL 配置
$mysql_address = "127.0.0.1";
$mysql_username = "root";
$mysql_password = "root";
$mysql_database = "stellarity";

// OneDrive 配置信息
$onedrive_client_id = "";
$onedrive_client_secret = "";
$onedrive_refresh_token = "";

// 一些配置信息
$list_result_number = 20;
$info_result_number = 5;
$banner = new SRL($SRLType->ServerBanner, "/data/574d3bc537df3a730c7fa40bd1f6d6126279fec5", "574d3bc537df3a730c7fa40bd1f6d6126279fec5");
$title = "Stellarity";
$backgroundData = new SRL($SRLType->BackgroundData, "/data/adad592c5532a4faf64bcd56f6ef1ac65d783e1f", "adad592c5532a4faf64bcd56f6ef1ac65d783e1f");
$backgroundConfiguration = new SRL($SRLType->BackgroundConfiguration, "/data/d6d0a3f33b1be72cf49c3e5fe7ef248ee8a0a5fa", "d6d0a3f33b1be72cf49c3e5fe7ef248ee8a0a5fa");
$warn_sha1 = "18d418a036faf35bbd17c9d265a782e32723356c";
$yes_sha1 = "87e0c3a0879345e2721f71b0540c5bd8a0f8d6c3";
$no_sha1 = "bd32c9acb1607e6ff65b52c75d8566667c75902f";

// 关卡搜索配置
$level_search = [ "options" => [
	[
		"query" => "name",
		"name" => "Chart ID",
		"type" => "text",
		"placeholder" => "With prefix \"wbs-\""
	], [
		"query" => "title",
		"name" => "Title",
		"type" => "text",
		"placeholder" => "Chart Title"
	], [
		"query" => "composer",
		"name" => "Composer",
		"type" => "text",
		"placeholder" => "Song Composer"
	], [
		"query" => "artists",
		"name" => "Artists",
		"type" => "text",
		"placeholder" => "Song Artists"
	], [
		"query" => "author",
		"name" => "Author",
		"type" => "text",
		"placeholder" => "Chart Author"
	], [
		"query" => "minLevel",
		"name" => "Minimal Level",
		"type" => "slider",
		"min" => 1,
		"max" => 50,
		"def" => 1,
		"step" => 1
	], [
		"query" => "maxLevel",
		"name" => "Maximal Level",
		"type" => "slider",
		"min" => 1,
		"max" => 50,
		"def" => 50,
		"step" => 1
	], [
		"query" => "type",
		"name" => "Search in ",
		"type" => "select",
		"values" => ["Public Chart", "Your Chart", "Liked Chart"],
		"def" => 0
	], [
		"query" => "code",
		"name" => "Login Code",
		"type" => "text",
		"placeholder" => "You don't need to input this if you just need to search chart."
	]
]];

// 预定义 Object 信息
$levels = [

];
$skins = [
	new SkinItem(
		"sirius",
		"Sirius",
		"World Dai Star: Dream's Stellarium",
		"LittleYang0531",
		new SRL($SRLType->SkinThumbnail, "/data/4d84f6ea99c28b7787161f012b353baf4c1752e7", "4d84f6ea99c28b7787161f012b353baf4c1752e7"),
		new SRL($SRLType->SkinData, "/data/a1737cf0cb97549d0a662a769461fb752720c32d", "a1737cf0cb97549d0a662a769461fb752720c32d"),
		new SRL($SRLType->SkinTexture, "/data/1d85380813552d515b77d4e5e8cf31e51537cdc8", "1d85380813552d515b77d4e5e8cf31e51537cdc8"),
		"Version: 1.0.0"
	)
];
$backgrounds = [
	new BackgroundItem(
		"sirius",
		"Sirius Default",
		"World Dai Star: Dream's Stellarium",
		"LittleYang0531",
		new SRL($SRLType->BackgroundThumbnail, "/data/4d84f6ea99c28b7787161f012b353baf4c1752e7", "4d84f6ea99c28b7787161f012b353baf4c1752e7"),
		$backgroundData,
		new SRL($SRLType->BackgroundImage, "/data/83e331c59146c674d5c3d6ed56ba5ac69ecca06a", "83e331c59146c674d5c3d6ed56ba5ac69ecca06a"),
		$backgroundConfiguration,
		"Version: 1.0.0"
	)
];
$effects = [
	new EffectItem(
		"sirius",
		"Sirius",
		"World Dai Star: Dream's Stellarium",
		"LittleYang0531",
		new SRL($SRLType->EffectThumbnail, "/data/4d84f6ea99c28b7787161f012b353baf4c1752e7", "4d84f6ea99c28b7787161f012b353baf4c1752e7"),
		new SRL($SRLType->EffectData, "/data/c5809b0d0f595655d669bf2d67cab30ce6bafdb5", "c5809b0d0f595655d669bf2d67cab30ce6bafdb5"),
		new SRL($SRLType->EffectAudio, "/data/fb615f16acdbf1f70bdf4253f665ec5d67e51e1c", "fb615f16acdbf1f70bdf4253f665ec5d67e51e1c"),
		"Version: 1.0.0"
	)
];
$particles = [
	new ParticleItem(
		"pjsekai",
		"PJSekai",
		"From servers.sonolus.com/pjsekai",
		"Burrito",
		new SRL($SRLType->ParticleThumbnail, "/data/e5f439916eac9bbd316276e20aed999993653560", "e5f439916eac9bbd316276e20aed999993653560"),
		new SRL($SRLType->ParticleData, "/data/3d6c06680612cb880c8552672ac2999cfaeb49a8", "3d6c06680612cb880c8552672ac2999cfaeb49a8"),
		new SRL($SRLType->ParticleTexture, "/data/57b4bd504f814150dea87b41f39c2c7a63f29518", "57b4bd504f814150dea87b41f39c2c7a63f29518"),
		"Version: 1.0.0"
	)
];
$engines = [
	new EngineItem(
		"sirius",
		"Sirius",
		"World Dai Star: Dream's Stellarium",
		"LittleYang0531",
		$skins[0],
		$backgrounds[0],
		$effects[0],
		$particles[0],
		new SRL($SRLType->EngineThumbnail, "/data/4d84f6ea99c28b7787161f012b353baf4c1752e7", "4d84f6ea99c28b7787161f012b353baf4c1752e7"),
		new SRL($SRLType->EnginePlayData, "/data/6048f038a17d0083c12a1390aa7281a14c293668", "6048f038a17d0083c12a1390aa7281a14c293668"),
		new SRL($SRLType->EnginePreviewData, "/data/e104c707cb3e9ac118128a00199d98ae7a197ac3", "e104c707cb3e9ac118128a00199d98ae7a197ac3"),
		new SRL($SRLType->EngineTutorialData, "/data/0a00ae6b688d19af9e8394e67c2df3236ecdb5e1", "0a00ae6b688d19af9e8394e67c2df3236ecdb5e1"),
		new SRL($SRLType->EngineRom, "/data/", ""),
		new SRL($SRLType->EngineConfiguration, "/data/b83d6e65e91fde752ea2f1b9fa875bfa939d7888", "b83d6e65e91fde752ea2f1b9fa875bfa939d7888"),
		"A recreation of World Dai Star: Dream's Stellarium engine in Sonolus.\nVersion: 1.0.0.20230919_beta\n\nGithub Repository\nhttps://github.com/SonolusHaniwa/sonolus-sirius-engine"
	)
];
$message_engine = new EngineItem("", "(Message)", "", "", $skins[0], $backgrounds[0], $effects[0], $particles[0], [], [], [], [], [] ,[], "");
?>
