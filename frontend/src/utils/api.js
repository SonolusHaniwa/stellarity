import { getBaseUrl } from "@/config/baseUrl.js";
import { inject, ref } from 'vue';
import { i18n } from '@/i18n';

const t = i18n.global.t;
export const isLoading = ref(true);
export const isLogin = ref(false);
export const isError = ref(false);
export const errorText = ref("");
export const progressBarValue = ref(0);
export const progressBarBuffer = ref(10);
var sessionId = "";

export function init() {
	const $cookies = inject('$cookies');
	sessionId = $cookies.get('sessionId');
	isLoading.value = true;
}

export async function checkLogin(resolve, reject) {
	isError.value = false; errorText.value = "";
	try {
		var res = await fetch(getBaseUrl().sonolusBaseUrl + "/user/mine", {
		    headers: {
		        'Content-Type': 'application/json',
		        'Authorization': sessionId
		    }
		});
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.fetch_failed');
		isLoading.value = false;
		console.log(err);
		throw Error("Failed to fetch: " + getBaseUrl().sonolusBaseUrl + "/user/mine");
	}
	res = JSON.parse(await res.text());
	if (res["code"] != 200) { 
		isLogin.value = false;
		isError.value = true;
		errorText.value = t('error.not_login');
		reject(res);
	} else { isLogin.value = true; resolve(res); }
}

export async function checkLogin2() {
	isError.value = false; errorText.value = "";
	try {
		var res = await fetch(getBaseUrl().sonolusBaseUrl + "/user/mine", {
		    headers: {
		        'Content-Type': 'application/json',
		        'Authorization': sessionId
		    }
		});
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.fetch_failed');
		isLoading.value = false;
		console.log(err);
		throw Error("Failed to fetch: " + getBaseUrl().sonolusBaseUrl + "/user/mine");
	} isLogin.value = true;
	res = JSON.parse(await res.text());
	return res;
}

export async function fetchLevelList(param) {
	isError.value = false; errorText.value = "";
	try {
		var res = await fetch(getBaseUrl().sonolusBaseUrl + "/levels/list" + param, {
		    headers: {
		        'Content-Type': 'application/json',
		        'Authorization': sessionId
		    }
		});
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.fetch_failed');
		isLoading.value = false;
		console.log(err);
		throw Error("Failed to fetch: " + getBaseUrl().sonolusBaseUrl + "/user/mine");
	}
	res = JSON.parse(await res.text());
	return res;
}

export async function uploadFile(sha, dataUrl) {
	progressBarValue.value = 0;
	progressBarBuffer.value = 10;
	isError.value = false; errorText.value = "";
	if (dataUrl == "") return;
	var block = 320 * 1024;
	var data = await fetch(dataUrl);
	var arrayBuffer = await data.arrayBuffer();
	var num = 100 / (1 + Math.ceil(arrayBuffer.byteLength / block));
	try {
		var res = await fetch(getBaseUrl().uploadUrl + sha, {
		    headers: {
		        'Content-Type': 'application/json',
		        'Authorization': sessionId
		    }
		});
		res = JSON.parse(await res.text());
		// 文件已存在
		if (res["code"] == 201) return;
		
		var uploadUrl = res["uploadUrl"];
		var token = res["token"];
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.upload_failed');
		console.log(err);
		throw Error("Failed to upload: " + getBaseUrl().sonolusBaseUrl + "/upload" + sha);
	} progressBarValue.value += num; progressBarBuffer.value += num + 1;

	var len = arrayBuffer.byteLength;
	for (var st = 0; st < len; st += block) {
		var en = Math.min(st + block, len);
		var dat = arrayBuffer.slice(st, en);
		try {
			await fetch(uploadUrl, {
				method: "PUT",
				headers: {
					"Authorization": "Bearer " + token,
					"Content-Length": en - st,
					"Content-Range": "Bytes " + st + "-" + (en - 1) + "/" + len
				},
				body: dat
			});
		} catch (err) {
			isError.value = true;
			errorText.value = t('error.upload_failed');
			console.log(err);
			throw Error("Failed to upload: " + uploadUrl);
		}
		progressBarValue.value += num; progressBarBuffer.value += num + 1;
	}
}

export async function createChart(options) {
	progressBarValue.value = 0;
	progressBarBuffer.value = 10;
	isError.value = false; errorText.value = "";
	
	const formData = new FormData();
	for (var option in options) formData.append(option, options[option]);

	try {
		var res = await fetch(getBaseUrl().sonolusBaseUrl + "/levels/create", {
			method: "POST",
		    headers: {
		        'Authorization': sessionId
		    },
		    body: formData
		});
		res = JSON.parse(await res.text());
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.create_failed');
		console.log(err);
		throw Error("Failed to upload: " + getBaseUrl().sonolusBaseUrl + "/upload" + sha);
	} progressBarValue.value += 100; progressBarBuffer.value += 111;
	return res["id"];
}

export async function getServerInfo() {
	isError.value = false; errorText.value = "";
	
	try {
		var res = await fetch(getBaseUrl().sonolusBaseUrl + "/server/info");
		res = JSON.parse(await res.text());
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.fetch_failed');
		isLoading.value = false;
		console.log(err);
		throw Error("Failed to fetch: " + getBaseUrl().sonolusBaseUrl + "/server/info");
	}

	return res;
}

export async function fetchChartInfo(id) {
	isError.value = false; errorText.value = "";
	try {
		var res = await fetch(getBaseUrl().sonolusBaseUrl + "/levels/wbs-" + id, {
		    headers: {
		        'Content-Type': 'application/json',
		        'Authorization': sessionId
		    }
		});
	} catch (err) {
		isError.value = true;
		errorText.value = t('error.fetch_failed');
		isLoading.value = false;
		console.log(err);
		throw Error("Failed to fetch: " + getBaseUrl().sonolusBaseUrl + "/levels/wbs-" + id);
	}
	res = JSON.parse(await res.text());
	if (res["code"] == 401) {
		isError.value = true;
		errorText.value = t('error.permission_denied');
		isLoading.value = false;
		throw Error("Permission Denied: " + getBaseUrl().sonolusBaseUrl + "/levels/wbs-" + id);
	}
	return res;
}
