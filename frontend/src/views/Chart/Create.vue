<script setup>
import { i18n } from '@/i18n';
import { ref } from "vue";
import { getBaseUrl } from "@/config/baseUrl.js";
import CryptoJS from 'crypto-js'
import AppScaffold from "@/components/AppScaffold/AppScaffold.vue";
import LoadingCircle from '../../components/LoadingCircle/LoadingCircle.vue';
import ErrorMessage from '../../components/ErrorMessage/ErrorMessage.vue';
import { 
	isLogin, isLoading, isError, errorText, progressBarValue, progressBarBuffer,
	checkLogin, uploadFile, createChart, init
} from '@/utils/api.js'
import factory from '@/utils/libsirius.js'
import { gzip } from 'pako'
import { sleep } from '@/utils/time.js'
import bgBaseUrl from './BackgroundImage.png';
import { useRouter } from 'vue-router';

const t = i18n.global.t
const url = getBaseUrl().sonolusBaseUrl + "/upload";
const route = useRouter();
const thumbnailHash = ref("Unknown"); var thumbnailUrl = "";
const backgroundHash = ref("Unknown"); var backgroundUrl = "";
const coverHash = ref("Unknown / Unknown");
const musicHash = ref("Unknown"); var musicUrl = "";
const dataHash = ref("Unknown"); var dataUrl = "";
const susHash = ref("Unknown"); var susUrl = "";
const chartHash = ref("Unknown / Unknown");
const title = ref("");
const composer = ref("");
const artists = ref("");
const author = ref("");
const isOlivier = ref(false);
const level = ref(25);
const description = ref("");
const isPublic = ref(false);
const globalDisabled = ref(false);
const uploading = ref(false);

async function loading() {
	init();
	await checkLogin((res) => {
		author.value = res["name"] + '#' + res["handle"];
	}, (res) => {});
	isLoading.value = false;
}
loading();

function dataURL2Blob(dataURL) {
	var arr = dataURL.split(","), mine = arr[0].match(/:(.*?);/)[1];
	var bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
	while(n--) u8arr[n] = bstr.charCodeAt(n);
	return new Blob([u8arr], {type: mine});
}
async function loadImage(url) {
	return new Promise((resolve, reject) => {
		var img = new Image();
		img.src = url; img.crossOrigin = "Anonymous";
		img.onload = () => { resolve(img); }
		img.onerror = () => { reject(new Error("Error " + url)); }
	});
}
async function getSha1(url) {
	var data = await fetch(url);
	var buffer = await data.arrayBuffer();
	var res = CryptoJS.lib.WordArray.create(buffer);
	return CryptoJS.SHA1(res).toString();
}
function uploadThumbnail() {
	var input = document.createElement("input");
	input.type="file";
	input.onchange = async function(){
		const coverUrl = window.URL.createObjectURL(this.files[0]);
		thumbnailUrl = coverUrl;
		var canvas = document.createElement("canvas");
		canvas.width = 1920; canvas.height = 1180;
		var context = canvas.getContext("2d");

		// 图片合成
		var cover = await loadImage(coverUrl);
		context.drawImage(cover, 741, 169, 450, 450);
		var bg = await loadImage(bgBaseUrl);
		context.drawImage(bg, 0, 0, 1920, 1180);
		
		var imgData = canvas.toDataURL({format: "png", quality: 1, width: 1920, height: 1180});
		var blob = dataURL2Blob(imgData);
		var bgUrl = window.URL.createObjectURL(blob);
		backgroundUrl = bgUrl;

		thumbnailHash.value = await getSha1(coverUrl);
		backgroundHash.value = await getSha1(bgUrl);
		coverHash.value = thumbnailHash.value + ' / ' + backgroundHash.value;
	}
	input.click();
}
function uploadMusic() {
	var input = document.createElement("input");
	input.type="file";
	input.onchange = async function() {
		musicUrl = window.URL.createObjectURL(this.files[0]);
		musicHash.value = await getSha1(musicUrl);
	}
	input.click();
}
function uploadChart() {
	var input = document.createElement("input");
	input.type="file";
	input.onchange = async function() {
		susUrl = window.URL.createObjectURL(this.files[0]);
		susHash.value = await getSha1(susUrl);

		// 读取谱面
		var data = await fetch(susUrl);
		var sus = await data.text();

		// 加载 WebAssembly
		var inst = await factory();
		var ptr = inst.stringToNewUTF8(sus);
		var res = inst._txt2data(inst._sus2txt(ptr));
		var dat = inst.UTF8ToString(res);

		// 谱面加密
		dat = gzip(dat, { level: 9 })
		var blob = new Blob([dat], { type: "application/gzip" });
		dataUrl = window.URL.createObjectURL(blob);
		dataHash.value = await getSha1(dataUrl);
		chartHash.value = susHash.value + ' / ' + dataHash.value;
	}
	input.click();
}
async function createLevel() {
	processId.value = 0; globalDisabled.value = true; uploading.value = true;
	processId.value++; await uploadFile(thumbnailHash.value, thumbnailUrl);
	processId.value++; await uploadFile(backgroundHash.value, backgroundUrl);
	processId.value++; await uploadFile(musicHash.value, musicUrl);
	processId.value++; await uploadFile(susHash.value, susUrl);
	processId.value++; await uploadFile(dataHash.value, dataUrl);
	processId.value++; var id = await createChart({
		isOlivier: isOlivier.value,
		level: (isOlivier.value ? Math.min(10, level.value) : level.value),
		title: title.value,
		artists: artists.value,
		composer: composer.value,
		author: author.value,
		description: description.value,
		isPublic: isPublic.value,
		coverHash: thumbnailHash.value,
		backgroundHash: backgroundHash.value,
		musicHash: musicHash.value,
		susHash: susHash.value,
		dataHash: dataHash.value
	}); processId.value++; await sleep(3000);
	route.push({
		name: 'chart_info',
		params: {
			id: id
		}
	});
}

const fileUploadList = [{
		model: coverHash,
		label: "thumbnail_and_background",
		hint: "thumbnail_hint",
		click: () => uploadThumbnail()
	}, {
		model: musicHash,
		label: "music",
		hint: "music_hint",
		click: () => uploadMusic()
	}, {
		model: chartHash,
		label: "chart_and_data",
		hint: "chart_hint",
		click: () => uploadChart()
	}
];
const infoList = [
	{ type: "text", model: title, label: "title" },
	{ type: "text", model: composer, label: "composer" },
	{ type: "text", model: artists, label: "artists" },
	{ type: "text", model: author, label: "author", disabled: true },
	{ type: "toggle", model: isOlivier, label: "is_olivier" },
	{ type: "level-slider", model: level, label: "level" },
	{ type: "textarea", model: description, label: "description" },
	{ type: "toggle", model: isPublic, label: "is_public" }
];
const olivierText = [ "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X" ];
const createProcess = [
	t("chart.create.process0"),
	t("chart.create.process1"),
	t("chart.create.process2"),
	t("chart.create.process3"),
	t("chart.create.process4"),
	t("chart.create.process5"),
	t("chart.create.process6"),
	t("chart.create.process7"),
];
const processId = ref(0);
</script>
<template>
	<AppScaffold>
        <LoadingCircle v-if="isLoading"></LoadingCircle>
		<ErrorMessage :isError="isError" :errorText="errorText"></ErrorMessage>
		<h1>{{ t('chart.create.index') }}</h1>
		<div class="app-scaffold-top" v-if="!isLoading && isLogin">
			<v-card :title="t('chart.create.index')">
				<v-card-text>
	                <span>
	                    <v-icon size="small" icon="mdi-file" class="mr-1"></v-icon>
	                    <span>{{ t('chart.create.upload') }}</span>
	                </span>
   	                <div class="d-flex mt-5" v-for="item in fileUploadList">
   	                	<v-text-field
   	                		:model-value="item.model"
   							:label="t('chart.create.' + item.label)"
   							density="compact"
   							:hint="t('chart.create.' + item.hint)"
   							variant="outlined"
   							focused
   							disabled
   						></v-text-field>
   						<v-btn 
   							class="ml-2"
   							color="primary" 
   							@click="item.click"
   							:disabled="globalDisabled"
   						>{{ t("global.upload") }}</v-btn>
   	                </div>
	            </v-card-text>
                <v-divider class="mx-4" />
	            <v-card-text>
	                <span>
	                    <v-icon size="small" icon="mdi-information" class="mr-1"></v-icon>
	                    <span>{{ t('chart.create.info') }}</span>
	                </span>
	                <div class="mt-5"><div v-for="item in infoList">
	                	<!-- text 选项 -->
	                	<v-text-field
	                		v-if="item.type == 'text'"
	                		:model-value="item.model"
							:label="t('chart.create.' + item.label)"
							:disabled="item.disabled || globalDisabled"
							:focused="item.disabled"
							density="compact"
							variant="outlined"
							color="primary"
							hide-details
							class="mt-3"
						></v-text-field>
						<!-- toggle 选项 -->
						<div v-if="item.type == 'toggle'" class="d-flex justify-space-between mt-3">
							<p style="flex-grow: 10000; line-height: 40px">{{ t('chart.create.' + item.label) }}</p>
							<v-switch 
								:model-value="item.model" 
								color="primary" 
								density="compact" 
								hide-details
   								:disabled="globalDisabled"
							></v-switch>
							<p style="line-height: 40px" class="ml-5">{{ item.model }}</p>
						</div>
						<!-- level-slider 选项 -->
						<div v-if="item.type == 'level-slider'" class="d-flex justify-space-between">
							<p style="line-height: 40px" class="mr-5">{{ t('chart.create.' + item.label) }}</p>
							<v-slider
								:model-value="item.model"
								:min=1
								:max="isOlivier ? 10 : 30"
								:step=1
								color="primary"
								density="compact"
								hide-details
   								:disabled="globalDisabled"
							></v-slider>
							<p style="line-height: 40px" class="ml-5">{{ isOlivier ? olivierText[Math.min(10, item.model.value) - 1] : item.model }}</p>
						</div>
						<!-- textarea 选项 -->
						<v-textarea
							v-if="item.type == 'textarea'"
							:model-value="item.model"
							:label="t('chart.create.' + item.label)"
							color="primary"
							class="mt-3"
							auto-grow
							hide-details
   							:disabled="globalDisabled"
						></v-textarea>
					</div></div>
	            </v-card-text>
                <v-divider class="mx-4" />
	            <v-card-text>
					<div class="d-flex justify-center mt-3"><v-btn
						color="primary"
						@click="createLevel()"
						:disabled="globalDisabled"
					>{{ t('global.submit') }}</v-btn></div>
					<div class="d-flex mt-3 align-center">
						<v-progress-circular
							indeterminate
							color="primary"
							:size="uploading ? 15 : 0"
							width="1"
							class="mr-1"
						></v-progress-circular>
						<p>{{ createProcess[processId] }}</p>
					</div>
					<v-progress-linear
						v-model="progressBarValue"
						:buffer-value="progressBarBuffer"
						color="primary"
						rounded
						stripted
					></v-progress-linear>
	            </v-card-text>
			</v-card>
		</div>
	</AppScaffold>
</template>
