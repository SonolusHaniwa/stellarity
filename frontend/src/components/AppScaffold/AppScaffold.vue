<script setup>
import ButtonNearby from './ButtonNearby.vue';

// Vue 3.2 currently doesn't support complex type in defineProps
// so the following is a workaround
// related issue: https://github.com/vuejs/core/issues/4294

// type Props = {
//   // columns on common mobile (default)
//   cols?: number | string;
//   sm?: number | string;
//   // columns on common desktop (>= md)
//   md?: number | string;
//   lg?: number | string;
//   xl?: number | string;

//   title?: string;
//   subtitle?: string;

//   // you can add a prev link and a link button to nearby page
//   nearbyPage?: NearbyPage;

//   // height of white space at page bottom
//   // so that user scroll bottom content of the page to near center of the screen
//   placeholderHeight?: string;
// };

const props = withDefaults(defineProps(), {
    cols: 12,
    sm: undefined,
    md: 8,
    lg: undefined,
    xl: undefined,
    placeholderHeight: '10vh',
});
</script>

<template>
    <!-- container, row and col can limit card's position -->
    <v-container>
        <v-row justify="center">
            <v-col v-bind="$props" class="app-scaffold">
                <div v-if="title" class="text-h3 mb-2 text-overflow-ellipsis-on-two-lines">
                    {{ title }}
                </div>
                <div v-if="subtitle" class="text-h5 text-grey text-overflow-ellipsis-on-two-lines">
                    {{ subtitle }}
                </div>
                <slot></slot>
                <v-row justify="space-between" align="center">
                    <v-col cols="4">
                        <ButtonNearby v-if="nearbyPage?.prevTo" type="prev" :title="nearbyPage?.prevTitle"
                            :to="nearbyPage?.prevTo" />
                    </v-col>
                    <v-col cols="4">
                        <ButtonNearby v-if="nearbyPage?.nextTo" type="next" :title="nearbyPage?.nextTitle"
                            :to="nearbyPage?.nextTo" />
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
    <div :style="{ height: placeholderHeight }"></div>
</template>

<style scoped>
.app-scaffold :deep(.v-card), .app-scaffold :deep(.card) {
    margin-top: 64px;
    margin-bottom: 64px;
}
</style>