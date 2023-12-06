import './assets/main.css'

import { createApp } from 'vue'

// @mdi/font
import '@mdi/font/css/materialdesignicons.css'

// vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'

// vue-i18n
import { i18n } from './i18n'

// vue-cookie
import VueCookies from 'vue-cookies'

import App from './App.vue'
import { router } from './router'

const vuetify = createVuetify({components})
createApp(App)
    .use(i18n)
    .use(vuetify)
    .use(router)
    .use(VueCookies)
    .mount('#app')
