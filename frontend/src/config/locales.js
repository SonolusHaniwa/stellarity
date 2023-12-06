import { en_us } from '@/i18n/en_us.js';
import { zh_cn } from '@/i18n/zh_cn.js';
import { ja_jp } from '@/i18n/ja_jp.js';

export const localeConfigs = {
    'en_us': {
        name: 'English',
        content: en_us,
    },
    'ja_jp': {
        name: '日本語',
        content: ja_jp,
    },
    'zh_cn': {
        name: '简体中文',
        content: zh_cn,
    },
};

export const defaultLocale = 'en_us';
