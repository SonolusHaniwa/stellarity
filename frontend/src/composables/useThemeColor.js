import { computed, watchEffect, ref } from 'vue';
import { useTheme } from 'vuetify';
import { storage } from '@/settings';
import { defaultPrimaryColor } from '@/config/color';

// set theme color from user settings
export function useThemeColor() {
    const primaryColor = computed(() => storage.value.primaryColor);
    const theme = useTheme();

    // update theme color when user settings changed
    watchEffect(() => {
        theme.themes.value.light.colors.primary = primaryColor.value;
        theme.themes.value.dark.colors.primary = defaultPrimaryColor;

        document.querySelector('meta[name="theme-color"]')
            ?.setAttribute('content', primaryColor.value);
    });
}