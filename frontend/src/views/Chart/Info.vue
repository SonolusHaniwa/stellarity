<script setup>
import { useRoute, useRouter } from 'vue-router';
import AppScaffold from '@/components/AppScaffold/AppScaffold.vue';
import LoadingCircle from '@/components/LoadingCircle/LoadingCircle.vue';
import ErrorMessage from '@/components/ErrorMessage/ErrorMessage.vue';
import ChartListItem from '@/components/ChartListItem/ChartListItem.vue';
import { ref, watch } from 'vue';
import { init, isLoading, isError, errorText, fetchChartInfo, checkLogin2 } from '@/utils/api.js';
import { getBaseUrl } from '@/config/baseUrl.js';
import { i18n } from '@/i18n';

const t = i18n.global.t;
const route = useRoute();
const router = useRouter();
var id = route.params.id;
const item = ref({});
const recommend = ref([]);
const olivierText = [ "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X" ];
const bgColor = ref("");
const levelText = ref("");
const editable = ref(false);

async function loadingData() {
	isLoading.value = true;
	isError.value = false; errorText.value = "";
    item.value = (await fetchChartInfo(id));
    var usr = await checkLogin2();
    recommend.value = item.value.recommendedRawItems;
    item.value = item.value.rawItem;
    if (usr["code"] == 200) editable.value = (usr["name"] + "#" + usr["handle"] == item.value.author);
   	bgColor.value = item.value.isOliver == 1 ? '#202020' : 'purple';
    levelText.value = item.value.isOliver == 1 ? 'Olivier ' + olivierText[item.value.level - 1] : 'Lv. ' + item.value.level;
    isLoading.value = false;
}

async function loading() {
    init();
    loadingData();
}

watch(() => route.params.id, (t, p) => {
	console.log(route.params.id);
	id = route.params.id;
	loadingData();
});

function onclick() {
	router.push({
		name: 'chart_edit',
		params: {
			id: id
		}
	});
}

loading();
</script>
<template>
    <AppScaffold>
        <LoadingCircle v-if="isLoading"></LoadingCircle>
		<ErrorMessage :isError="isError" :errorText="errorText"></ErrorMessage>
		<div v-if="!isLoading && !isError" style="max-width: 600px; margin: auto">
			<!-- 信息头 -->
	        <div class="d-flex justify-space-between">
				<div class="d-flex flex-column justify-space-between chart-card-text">
					<div>
						<p style="font-size: 40px; font-weight: 400">{{ item.title }}</p>
					</div>
					<div style="font-size: 16px">
						<p><v-icon icon="mdi-music"></v-icon> {{ item.artists }}</p>
						<p><v-icon icon="mdi-microphone"></v-icon> {{ item.composer }}</p>
						<p><v-icon icon="mdi-pen"></v-icon> {{ item.author }}</p>
						<p style="color: grey"># {{ id }}</p>
					</div>
				</div>
				<div style="width: 176px">
		            <v-img
		                :src="getBaseUrl().dataBaseUrl + item.coverHash" 
		                max-width="176" aspect-ratio="1" 
		                style="border-radius: 8px"
		            ><v-chip
						class="rounded-0 rounded-ts-lg" 
						:color="bgColor"
						variant="flat"
						size="small"
					>{{ levelText }}</v-chip></v-img>
		            <v-btn
		            	color="primary"
		            	class="mt-3"
		            	style="width: 100%"
		            	:href="getBaseUrl().openInSonolusBaseUrl + '/levels/wbs-' + id"
		            ><v-icon icon="mdi-link"></v-icon>&nbsp;{{ t('global.open_in_sonolus') }}</v-btn>
		            <v-btn
		            	v-if="editable"
		            	color="primary"
		            	class="mt-3"
		            	style="width: 100%"
		            	@click="onclick"
		            ><v-icon icon="mdi-pen"></v-icon>&nbsp;{{ t('global.edit') }}</v-btn>
		        </div>
	        </div>

	        <!-- 谱面描述 -->
	        <div class="mt-5" style="min-height: 200px">
	        	<h1>{{ t('chart.info.description') }}</h1>
	        	{{ item.description }}
	        </div>

	        <!-- 同作者谱面 -->
	        <div class="mt-5">
	        	<h1>{{ t('chart.info.same_author') }}</h1>
	        	<ChartListItem v-for="it in recommend" :item="it" class="ml-auto mr-auto mt-3"></ChartListItem>
	        </div>
        </div>
    </AppScaffold>
</template>
