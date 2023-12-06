<script setup>
import { i18n } from '@/i18n';
import { ref, computed } from "vue";
import ChartListItem from "@/components/ChartListItem/ChartListItem.vue";

const props = defineProps(['isLoading', 'keyword', 'items', 'pages', 'currentPage', 'i18nPrefix']);
defineEmits(['update:keyword', 'update:currentPage']);

const t = i18n.global.t;
const items = computed(() => props.items);
const pages = computed(() => props.pages);
const currentPage = computed(() => props.currentPage);
const keyword = computed(() => props.keyword);
const i18nPrefix = computed(() => props.i18nPrefix);
</script>
<template>
    <div class="d-flex" style="width: 85%; margin: auto">
        <v-text-field
            v-model="keyword"
            :label="t(i18nPrefix + 'search_title')"
            variant="outlined"
            :hint="t(i18nPrefix + 'search_title_hint')"
            density="compact"
            @update:modelValue="$emit('update:keyword', $event)"
            color="primary"
        ></v-text-field>
        <v-btn 
            style="margin-left: 10px;"
            @click="$emit('update:currentPage', 1)"
            color="primary"
        >{{ t(i18nPrefix + 'search_button') }}</v-btn>
    </div>
    <v-pagination 
        :model-value="currentPage" 
        :length="pages" 
        total-visible="7"
        style="margin-bottom: 10px"
        @update:model-value="$emit('update:currentPage', $event)"
    ></v-pagination>
    <div class="d-flex flex-wrap justify-center" style="gap: 1em">
        <ChartListItem v-for="item in items['rawItems']" :item="item"></ChartListItem>
    </div>
    <v-pagination 
        :model-value="currentPage" 
        :length="pages" 
        total-visible="7"
        style="margin-top: 10px"
        @update:model-value="$emit('update:currentPage', $event)"
    ></v-pagination>
</template>

<style scoped>
</style>
