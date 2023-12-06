<script setup>
import { RouterLink, RouterView } from 'vue-router'
import AppNavigationBar from './components/AppNavigationBar/AppNavigationBar.vue';
import { useThemeColor } from './composables/useThemeColor';
import { useDisplay } from 'vuetify'

const { mobile } = useDisplay();

useThemeColor();
</script>

<template>
	<v-app>
		<AppNavigationBar></AppNavigationBar>
		<v-main 
			v-if="!mobile.value"
			style="width: 1280px; padding-left: 0px"
		>
			<router-view v-slot="{ Component }">
				<component :is="Component"></component>
			</router-view>
		</v-main>
	</v-app>
</template>

<style>
#app {
	display: block;
	padding: 0px;
}
body {
	background-color: var(--v-background-base);
}
</style>
