<script setup>
import { i18n } from '@/i18n';
import { ref, computed, watch } from "vue";

const t = i18n.global.t;

const props = defineProps(['isError', 'errorText']);

var isError2 = computed(() => props.isError);
var errorText2 = computed(() => props.errorText);
</script>

<template>
    <v-snackbar v-model="isError2">
        {{ errorText2 }}
        <template v-slot:actions>
            <v-btn color="primary" @click="isError = false">{{ t('global.close') }}</v-btn>
        </template>
    </v-snackbar>
</template>