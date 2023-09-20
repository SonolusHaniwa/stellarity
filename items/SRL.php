<?php
class SRLType {
	public $LevelCover = "LevelCover";
    public $LevelBgm = "LevelBgm";
    public $LevelPreview = "LevelPreview";
    public $LevelData = "LevelData";
    public $SkinThumbnail = "SkinThumbnail";
    public $SkinData = "SkinData";
    public $SkinTexture = "SkinTexture";
    public $BackgroundThumbnail = "BackgroundThumbnail";
    public $BackgroundData = "BackgroundData";
    public $BackgroundImage = "BackgroundImage";
    public $BackgroundConfiguration = "BackgroundConfiguration";
    public $EffectThumbnail = "EffectThumbnail";
    public $EffectData = "EffectData";
    public $EffectAudio = "EffectAudio";
    public $ParticleThumbnail = "ParticleThumbnail";
    public $ParticleData = "ParticleData";
    public $ParticleTexture = "ParticleTexture";
	public $EngineThumbnail = "EngineThumbnail";
    public $EngineData = "EngineData";
    public $EngineRom = "EngineRom";
    public $EngineConfiguration = "EngineConfiguration";
    public $ServerBanner = "ServerBanner";
	public $EnginePlayData = "EnginePlayData";
	public $EngineTutorialData= "EngineTutorialData";
	public $EnginePreviewData = "EnginePreviewData";
}$SRLType;

class SRL {
	public $type = "";
	public $url = "";
	public $hash = "";

	public function __construct($type, $url, $hash) {
		$this->type = $type;
		$this->url = $url;
		$this->hash = $hash;
	}
};
?>
