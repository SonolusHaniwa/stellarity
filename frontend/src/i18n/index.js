import { zh_cn } from "./zh_cn.js"
import { en_us } from "./en_us.js"
import { ja_jp } from "./ja_jp.js"
import { createI18n } from 'vue-i18n'
import { storage } from "@/settings/index.js"
import { computed } from "vue"

const message = { 
    "en_us": en_us, 
    "zh_cn": zh_cn, 
    "ja_jp": ja_jp
};
export const i18n = createI18n({
    legacy: false,
    locale: storage.value.locale,
    messages: message
})
