<script setup>
import { getBaseUrl } from "@/config/baseUrl.js"
import { useRouter } from "vue-router";
import { ref } from 'vue';

/* 
item: ChartListItem = {
	name: string,
	isOliver bool,
	level int,
	title string,
	artists string,
	composer string,
	author string,
	description string,
	isPublic bool,
	createTime int,
	publishTime int,
	lastEdited int,
	coverHash string,
	backgroundHash string,
	musicHash string,
	dataHash string
}
*/
const props = defineProps(['item']);
const route = useRouter();
const olivierText = [ "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X" ];
const bgColor = ref(props.item.isOliver == 1 ? '#202020' : 'purple');
const levelText = (props.item.isOliver == 1 ? 'Olivier ' + olivierText[props.item.level - 1] : 'Lv. ' + props.item.level);

function onclick() {
	route.push({
		name: 'chart_info',
		params: {
			id: props.item.name.substr(4)
		}
	});
}
</script>

<template>
<v-sheet width="480" height="192" :elevation="3" v-on:click="onclick">
	<div class="d-flex chart-card" style="cursor:pointer">
		<v-img
			:src="getBaseUrl().dataBaseUrl + item.coverHash" 
			width="176" aspect-ratio="1" 
			style="border-radius: 8px"
		><v-chip 
			class="rounded-0 rounded-ts-lg" 
			:color="bgColor" 
			variant="flat"
			size="small"
		>{{ levelText }}</v-chip></v-img>
		<div class="d-flex flex-column justify-space-between chart-card-text">
			<div>
				<h1>{{ item.title }}</h1>
			</div>
			<div>
				<p><v-icon icon="mdi-music"></v-icon> {{ item.artists }}</p>
				<p><v-icon icon="mdi-microphone"></v-icon> {{ item.composer }}</p>
				<p><v-icon icon="mdi-pen"></v-icon> {{ item.author }}</p>
			</div>
		</div>
	</div>
</v-sheet>
</template>

<style scoped>
.chart-card {
	padding: 8px;
}

.chart-card-text {
	flex-grow: 10000;
	padding-left: 10px;
}

.chart-card :deep(h1) {
	font-weight: 400;
}

.chart-card :deep(p) {
	font-weight: 300;
	font-size: 12px;
}
</style>
