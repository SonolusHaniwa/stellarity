import { storage } from '@/settings'

export const baseUrl = {
	"global": {
		staticBaseUrl: "https://stellarity.littleyang.me/static/",
		masterBaseUrl: "https://raw.githubusercontent.com/SonolusHaniwa/sirius-decrypted-data/main/master/",
		sonolusBaseUrl: "https://stellarity.littleyang.me/sonolus",
		openInSonolusBaseUrl: "sonolus://stellarity.littleyang.me",
		dataBaseUrl: "https://stellarity.littleyang.me/data/",
		uploadUrl: "https://stellarity.littleyang.me/upload/"
	},
	"proxy": {
		staticBaseUrl: "https://stellarity.littleyang.me/static/",
		masterBaseUrl: "https://corsproxy.org/?https://raw.githubusercontent.com/SonolusHaniwa/sirius-decrypted-data/main/master/",
		sonolusBaseUrl: "https://stellarity.littleyang.me/sonolus",
		openInSonolusBaseUrl: "sonolus://stellarity.littleyang.me",
		dataBaseUrl: "https://stellarity.littleyang.me/data/",
		uploadUrl: "https://stellarity.littleyang.me/upload/"
	},
	 "dev": {
		staticBaseUrl: "https://stellarity.littleyang.me/static/",
		masterBaseUrl: "https://corsproxy.org/?https://raw.githubusercontent.com/SonolusHaniwa/sirius-decrypted-data/main/master/",
		sonolusBaseUrl: "http://127.0.0.1:8081/sonolus",
		openInSonolusBaseUrl: "sonolus://stellarity.littleyang.me",
		dataBaseUrl: "https://stellarity.littleyang.me/data/",
		uploadUrl: "https://stellarity.littleyang.me/upload/"
	}
};

export const supportedServers = [ "global", "proxy" ];

export const defaultServer = "global";

var currentServer = storage.value.server;
export function setBaseUrlByServer(server) {
	currentServer = server;
}
export function getBaseUrl() {
	return baseUrl[currentServer];
}
