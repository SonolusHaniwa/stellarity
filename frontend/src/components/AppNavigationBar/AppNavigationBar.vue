<script setup>
import { ref } from 'vue';
import { useDisplay } from 'vuetify'

const { mobile } = useDisplay();
const drawer = ref(!mobile.value);

import AppBar from './AppBar.vue';
import NavigationDrawer from './NavigationDrawer.vue';
</script>

<template>
    <AppBar v-model:drawer="drawer"></AppBar>
    <NavigationDrawer v-model:drawer="drawer"></NavigationDrawer>
</template>
