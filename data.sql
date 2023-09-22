CREATE TABLE Levels (
	name text,
	isOliver bool,
	level int,
	title text,
	artists text,
	composer text,
	author text,
	description text,
	isPublic bool,
	createTime int,
	publishTime int,
	lastEdited int,
	coverHash text,
	backgroundHash text,
	musicHash text,
	dataHash text
);
INSERT INTO Levels VALUES ("wbs-test", true, 9, "Realize", "Unknown", "Unknown", "LittleYang0531", "自制谱平台测试", false, 0, 0, 0, "", "", "", "");
CREATE TABLE LoginRequest (
	code text,
	session text,
	time int,
	userId text,
	userAgent text,
	ip text
);
CREATE TABLE UserProfile (
	id text,
	handle text,
	name text,
	avatarForegroundColor text,
	avatarBackgroundColor text,
	aboutMe text,
	socialLinks text,
	favorites text
);
CREATE TABLE UserSession (
	id text,
	aesKey text,
	aesIv text,
	time int
);
CREATE TABLE LikeTable (
	chartName text,
	userId text,
	likeTime int
);
