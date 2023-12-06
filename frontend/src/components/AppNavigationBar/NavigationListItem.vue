<script setup>

import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { i18n } from '@/i18n';

const t = i18n.global.t;

/* 
item: NagivationItemProp = { 
	title: string, 
	icon: string, 
	href: string, 
	subItems: NavigationItemProp[] 
}
 */
const props = defineProps(['item']);

const route = useRoute();

const active = computed(() => {
    const href = props.item.href;
    return !!href && (route.path === href || route.path.startsWith(`${href}/`));
});

const linkProp = computed(() => {
    const href = props.item.href;
    // is not a valid URL
    if (!href)
        return {};

    // is external link, use href
    if (href.startsWith('http'))
        return { href, target: '_blank' };

    // is internal link, use router-link
    return { to: href };
});
</script>
<template>
    <!-- is a group with recursive items -->
    <v-list-group v-if="item.subItems">
        <template #activator="{ props: slotProps }">
            <NavigationListItem 
                v-bind="{ ...$attrs, ...slotProps }" 
                :item="{ ...item, subItems: null }"
            ></NavigationListItem>
        </template>
        <NavigationListItem 
            v-for="subItem in item.subItems" 
            :key="t(subItem.title)" 
            :item="subItem"
        ></NavigationListItem>
    </v-list-group>
    <!-- otherwise is a simple item -->
    <v-list-item v-else 
        v-bind="$attrs" 
        :prepend-icon="item.icon" 
        :title="t(item.title)" 
        :to="linkProp.to"
        :href="linkProp.href" 
        :target="linkProp.target" 
        :value="item.href" 
        :active="active" 
        color="primary"
    ></v-list-item>
</template>
