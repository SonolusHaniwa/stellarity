<script setup>
import { i18n } from '@/i18n';
import { ref, computed } from 'vue';
import AppScaffold from '@/components/AppScaffold/AppScaffold.vue';
import { localeConfigs } from '@/config/locales.js';
import { supportedServers } from '@/config/baseUrl.js';
import { storage } from '@/settings';
import { colors } from '@/config/color.js';
import ButtonAction from '../../components/ButtonAction/ButtonAction.vue';
import { watch } from 'vue';

const t = i18n.global.t;
const locale = ref(storage.value.locale);
watch(locale, () => {
    i18n.global.locale.value = locale.value;
    i18n.global.setLocaleMessage(locale.value, localeConfigs[locale.value].content);
});
const inputColor = ref(storage.value.primaryColor);

const inputColorRules = [
    (v) => {
        const isValid = /^#[A-Fa-f0-9]{6}$/.test(v);
        return isValid || t('settings.server.invalid_color_value');
    },
];
const inputColorIsValid = computed(() => inputColorRules.every(rule => rule(inputColor.value) === true));

function setPrimaryColor(val) {
    inputColor.value = val;
    storage.value.primaryColor = val;
}
function setLocale(val) {
    locale.value = val;
    storage.value.locale = val;
}
function setServer(val) {
    storage.value.server = val;
    setBaseUrlByServer(val);
}
</script>

<template>
    <AppScaffold>
        <h1>{{ t('settings.server.title') }}</h1>
        <v-card :title="t('settings.server.language_and_server')">
            <!-- Language Settings -->
            <v-card-text>
                <span>
                    <v-icon size="small" icon="mdi-translate" class="mr-1"></v-icon>
                    <span>{{ t('settings.server.language') }}</span>
                </span>
                <v-chip-group 
                    :model-value="storage.locale" 
                    :color="storage.primaryColor" 
                    mandatory
                    @update:model-value="(val) => setLocale(val)"
                >
                    <v-chip v-for="(locale, key) in localeConfigs" :key="key" :value="key">{{ locale.name }}</v-chip>
                </v-chip-group>
            </v-card-text>

            <v-divider class="mx-4" />

            <!-- Server Settings -->
            <v-card-text>
                <span>
                    <v-icon size="small" icon="mdi-server" class="mr-1"></v-icon>
                    <span>{{ t('settings.server.server') }}</span>
                </span>
                <v-chip-group :model-value="storage.server" :color="storage.primaryColor" mandatory
                    @update:model-value="(val) => setServer(val)">
                    <v-chip v-for="server in supportedServers" :key="server" :value="server">{{
                        $t(`settings.server.list.${server}`) }}</v-chip>
                </v-chip-group>
            </v-card-text>
        </v-card>
        <v-card :title="t('settings.server.ui')">
            <!-- Color Settings -->
            <v-card-text>
                <span>
                    <v-icon size="small" icon="mdi-palette" class="mr-1" />
                    <span>{{ t('settings.server.color') }}</span>
                </span>

                <v-item-group :model-value="primary" selected-class="preview-color-selected" mandatory
                    @update:model-value="(val) => setPrimaryColor(val)">
                    <div class="mt-2 d-flex justify-start flex-wrap">
                        <v-item v-for="color in colors" :key="color" v-slot="{ selectedClass, toggle }" :value="color">
                            <div class="preview-color ma-1 elevation-2 flex-shrink-0" :class="selectedClass"
                                :style="{ backgroundColor: color }" @click="toggle" />
                        </v-item>
                    </div>
                </v-item-group>

                <div id="custom-color-input" class="d-flex align-center mt-4">
                    <v-text-field v-model="inputColor" :rules="inputColorRules" :counter="7" :label="t('settings.server.custom_color')"
                        variant="solo" density="comfortable">
                        <template #append-inner>
                            <div class="preview-color"
                                :style="{ backgroundColor: inputColorIsValid ? inputColor : 'transparent' }" />
                        </template>
                        <template #append>
                            <ButtonAction :disabled="!inputColorIsValid" color="primary"
                                :onClick="() => setPrimaryColor(inputColor)">
                                {{ t('settings.server.apply_color') }}
                            </ButtonAction>
                        </template>
                    </v-text-field>
                </div>
            </v-card-text>
        </v-card>
    </AppScaffold>
</template>

<style scoped>
.preview-color {
    height: 24px;
    width: 24px;
    padding: 0;
}

.preview-color-selected {
    height: 24px;
    width: 24px;
    padding: 0;
    border: 2px solid #fff;
}

#custom-color-input :deep(.v-input__append), 
#custom-color-input :deep(.v-field__append-inner) {
    padding-top: 0;
    padding-bottom: 0;
    margin-top: auto;
    margin-bottom: auto;
}
</style>