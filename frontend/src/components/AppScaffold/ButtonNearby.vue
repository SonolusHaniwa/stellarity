<script setup>
import { computed } from 'vue'
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth',
    });
}

const props = defineProps(['type', 'title', 'to']);

const VBtnIconProps = computed(() =>
    props.type === 'prev'
        ? { prependIcon: 'mdi-arrow-left' }
        : { appendIcon: 'mdi-arrow-right' },
);

function scrollToTopInNewPage() {
    setTimeout(scrollToTop, 100);
}
</script>

<template>
    <v-btn variant="text" height="unset" min-height="36px" block :to="to" v-bind="VBtnIconProps"
        @click="scrollToTopInNewPage">
        <div class="button-text-multiline">
            {{ title }}
        </div>
    </v-btn>
</template>

<style scoped>
.button-text-multiline {
    overflow: hidden;
    text-align: center;
    white-space: normal;
}
</style>