import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ChartInfo from '../views/Chart/Info.vue'
import ChartList from '../views/Chart/List.vue'
import ChartMine from '../views/Chart/Mine.vue'
import ChartCreate from '../views/Chart/Create.vue'
import ChartEdit from '../views/Chart/Edit.vue'
import SettingsServer from '../views/Settings/Server.vue'
import SettingsSonolus from '../views/Settings/Sonolus.vue'
import NotFound from '../views/404.vue'

export const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
	    {
			path: '/home',
			name: 'home',
			component: HomeView
		}, {
			path: '/',
			redirect: '/home'
		}, {
			path: '/chart/:id/info',
			name: 'chart_info',
			component: ChartInfo
		}, {
			path: '/chart/list',
			name: 'chart_list',
			component: ChartList
		}, {
			path: '/chart/mine',
			name: 'chart_mine',
			component: ChartMine
		}, {
			path: '/chart/create',
			name: 'chart_create',
			component: ChartCreate
		}, {
			path: '/chart/:id/edit',
			name: 'chart_edit',
			component: ChartEdit
		}, {
			path: '/settings/server',
			name: 'settings_server',
			component: SettingsServer
		}, {
			path: '/settings/sonolus',
			name: 'settings_sonolus',
			component: SettingsSonolus
		}, {
			path: '/:pathMatch(.*)*',
			name: '404',
			component: NotFound
		}
	]
});

export function goto(name, params) {
	router.push({ name, params });
}
