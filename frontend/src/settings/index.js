import { useStorage } from "@vueuse/core";
import { defaultPrimaryColor } from "@/config/color.js"

export const storage = useStorage("Settings", {
    locale: "en_us",
    server: "global",
    primaryColor: defaultPrimaryColor
});