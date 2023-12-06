<script setup>
import { i18n } from '@/i18n';
import { ref } from "vue";
import LoadingCircle from "@/components/LoadingCircle/LoadingCircle.vue";
import AppScaffold from "@/components/AppScaffold/AppScaffold.vue";
import { isLoading, isError, errorText, fetchLevelList, init, checkLogin } from "@/utils/api.js"
import ErrorMessage from '../../components/ErrorMessage/ErrorMessage.vue';
import ChartList from '../../components/ChartList/ChartList.vue';

const t = i18n.global.t;
const items = ref([]);
const pages = ref(1);
const keyword = ref("");
const currentPage = ref(1);

async function updatePage(page) {
	var param = "?page=" + (page - 1) + "&type=1";
    if (keyword.value != "") param += "&title=" + keyword.value;
	items.value = {}; isLoading.value = true; currentPage.value = page;
	var res = await fetchLevelList(param);
	items.value = res; pages.value = Math.max(1, res["pageCount"]);
	isLoading.value = false;
}

async function loading() {
	init();
	await checkLogin((res) => {
		updatePage(1);
	}, (res) => { isLoading.value = false; });
}
loading();

function updateKeyword(k) {
    keyword.value = k;
}
</script>
<template>
	<AppScaffold>
		<h1>{{ t('chart.mine.index') }}</h1>
		<LoadingCircle v-if="isLoading"></LoadingCircle>
		<ErrorMessage :isError="isError" :errorText="errorText"></ErrorMessage>
		<div class="app-scaffold-top">
			<ChartList 
				:isLoading="isLoading" 
				:keyword="keyword" 
				:items="items"
				:pages="pages"
				:currentPage="currentPage"
				i18nPrefix="chart.mine."
				@update:keyword="updateKeyword"
				@update:currentPage="updatePage"
			></ChartList>
		</div>
	</AppScaffold>
</template>
