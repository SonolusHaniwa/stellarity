<script setup>
import { i18n } from '@/i18n';
import { goto } from '@/router';
import { useRoute } from 'vue-router';
import { ref, watchEffect } from 'vue';

defineProps(['drawer']);
defineEmits(['update:drawer']);

const t = i18n.global.t;
const route = useRoute();
const title = ref("");
const appBarTitle = ref(t('title'));
watchEffect(() => {
	title.value = route.name ? t('route.' + route.name) : '';
	appBarTitle.value = title.value ? title.value + ' | ' + t('title') : t('title');
	document.title = appBarTitle.value;
});
</script>

<template>
	<v-app-bar :elevation="2" color="primary">
		<template #prepend>
		    <v-app-bar-nav-icon @click="$emit('update:drawer', !drawer)"></v-app-bar-nav-icon>
		</template>
		<v-app-bar-title>{{ appBarTitle }}</v-app-bar-title>
		<template #append>
			<v-app-bar-nav-icon icon="mdi-cog" @click="goto('settings_server')"></v-app-bar-nav-icon>
		</template>
	</v-app-bar>
</template>
