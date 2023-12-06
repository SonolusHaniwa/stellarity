import { i18n } from '@/i18n';

const t = i18n.global.t;

export const navigationDrawerList = [
	{ title: 'appbar.home', icon: 'mdi-bullhorn-variant', href: '/home' },
	{ title: 'appbar.chart.index', icon: 'mdi-music', subItems: [
		{ title: 'appbar.chart.list', href: '/chart/list' },
		{ title: 'appbar.chart.mine', href: '/chart/mine' },
		{ title: 'appbar.chart.create', href: '/chart/create' },
//		{ title: 'appbar.chart.liked', href: '/chart/liked' }
	] },
/*	{ title: 'appbar.information.index', icon: 'mdi-information-outline', subItems: [
		{ title: 'appbar.information.performance', href: '/info/performance' },
		{ title: 'appbar.information.audition', href: '/info/audition' },
		{ title: 'appbar.information.league', href: '/info/league' },
		{ title: 'appbar.information.lesson', href: '/info/lesson' },
	] },
	{ title: 'appbar.character.index', icon: 'mdi-human', subItems: [
		{ title: 'appbar.character.list', href: '/character/list' },
		{ title: 'appbar.character.card', href: '/character/card' },
		{ title: 'appbar.character.poster', href: '/character/poster' },
		{ title: 'appbar.character.accessory', href: '/character/accessory' },
		{ title: 'appbar.character.photo', href: '/character/photo' }
	] },
	{ title: 'appbar.story.index', icon: 'mdi-book', subItems: [
		{ title: 'appbar.story.main', href: '/story/main' },
		{ title: 'appbar.story.character', href: '/story/character'},
		{ title: 'appbar.story.event', href: '/story/event' }
	] },
	{ title: 'appbar.event.index', icon: 'mdi-flag', subItems: [
		{ title: 'appbar.event.list', href: '/event/list' },
		{ title: 'appbar.event.shop', href: '/event/shop' },
		{ title: 'appbar.event.gacha', href: '/event/gacha' }
	] },*/
	{ title: 'appbar.settings.index', icon: 'mdi-cog', subItems: [
		{ title: 'appbar.settings.server', href: '/settings/server' },
		{ title: 'appbar.settings.sonolus', href: '/settings/sonolus' },
//		{ title: 'appbar.settings.game', href: '/settings/game' }
	] }
];
