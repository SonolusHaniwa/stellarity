<script setup>
import NavigationListItem from './NavigationListItem.vue'; 
import { navigationDrawerList } from '../../config/navigationDrawerList';
import { i18n } from '@/i18n';

const t = i18n.global.t;

defineProps(['drawer']);
defineEmits(['update:drawer']);
</script>

<template>
	<v-navigation-drawer :model-value="drawer" @update:model-value="(val) => $emit('update:drawer', val)">
		<v-list dense nav density="compact">
			<v-item-group mandatory>
				<NavigationListItem
					v-for="item in navigationDrawerList"
					:key="t(item.title)"
					:item="item"
				/>
			</v-item-group>
		</v-list>
	</v-navigation-drawer>
</template>
