<script setup>
import { i18n } from '@/i18n';
import { ref } from "vue";
import { getBaseUrl } from "@/config/baseUrl.js";
import AppScaffold from '../../components/AppScaffold/AppScaffold.vue';
import LoadingCircle from '../../components/LoadingCircle/LoadingCircle.vue';
import { inject } from 'vue';

const t = i18n.global.t;
const $cookies = inject('$cookies');

var sessionId = $cookies.get('sessionId');
const isLogin = ref(false);
const isLoading = ref(true);
const loadingLoadSuccess = ref(false);
const isError = ref(false);
const errorText = ref("");
const userId = ref("");
const userHandle = ref("");
const userName = ref("");  

const loginIsLoading = ref(true);
const loginCode = ref("00000000");

var url = getBaseUrl().sonolusBaseUrl + "/user/mine";
fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': sessionId
    }
}).then((res) => res.json())
.then((val) => {
    loadingLoadSuccess.value = true;
    // 未登录
    if (val["code"] != 200) { 
        isLogin.value = false;
        var url = getBaseUrl().sonolusBaseUrl + "/user/login";
        fetch(url).then((res) => res.json()).then((val) => {
            loginCode.value = val["code"];
            $cookies.set('sessionId', val["sessionId"], '30d')
            sessionId = val["sessionId"];
        }).finally(() => { loginIsLoading.value = false })
        .catch(() => {
        	loginIsLoading.value = true;
        	isError.value = true;
        	errorText.value = t('error.fetch_failed');
        	throw Error("Failed to fetch: " + url);
        });

        // 轮询
        var timer = setInterval(() => {
            var url = getBaseUrl().sonolusBaseUrl + "/user/mine";
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': sessionId
                }
            }).then((res) => res.json())
            .then((val) => {
                if (val["code"] == 200) {
                    clearInterval(timer);
                    location.href = location.href;
                }
            })
        }, 1000);
    }
    // 已登录 
    else {
        isLogin.value = true;
        userId.value = val["id"];
        userHandle.value = val["handle"];
        userName.value = val["name"];
    }
}).finally(() => { isLoading.value = false })
.catch(() => {
	isLoading.value = false;
	isError.value = true;
	errorText.value = t('error.fetch_failed');
	throw Error("Failed to fetch: " + url);
});

function logout() {
    $cookies.remove('sessionId');
    location.href = location.href;
}
</script>

<template>
    <AppScaffold>
        <LoadingCircle v-if="isLoading"></LoadingCircle>
        <h1>{{ t('settings.sonolus.title') }}</h1>
		<v-snackbar v-model="isError">
			{{ errorText }}
			<template v-slot:actions>
				<v-btn color="primary" @click="isError = false">{{ t('global.close') }}</v-btn>
			</template>
		</v-snackbar>
        <div v-if="!isLoading && loadingLoadSuccess" class="app-scaffold-top">
            <div v-if="isLogin">
                <v-card :title="t('settings.sonolus.user_title')">
                    <v-card-text>
                        <span>
                            <v-icon size="small" icon="mdi-human" class="mr-1"></v-icon>
                            <span>{{ t('settings.sonolus.user_info') }}</span>
                        </span>
                        <v-text-field
                            :label="t('settings.sonolus.user_id')"
                            :value="userId"
                            density="compact"
                            variant="outlined"
                            focused
                            disabled
                            class="mt-3"
                        ></v-text-field>
                        <v-text-field
                            :label="t('settings.sonolus.user_handle')"
                            :value="userHandle"
                            density="compact"
                            variant="outlined"
                            focused
                            disabled
                        ></v-text-field>
                        <v-text-field
                            :label="t('settings.sonolus.user_name')"
                            :value="userName"
                            density="compact"
                            variant="outlined"
                            focused
                            disabled
                        ></v-text-field>
                        <div class="d-flex justify-end">
                            <v-btn
                                @click="logout()"
                                color="primary"
                            >{{ t('settings.sonolus.user_logout') }}</v-btn>
                        </div>
                    </v-card-text>
                </v-card>
            </div>
            <div v-else>
                <v-card :title="t('settings.sonolus.login_title')">
                    <v-card-text>
                        <span>{{ t('settings.sonolus.login_code') }}</span>
                        <v-otp-input
                            disabled="disabled"
                            length="8"
                            max-width="400"
                            v-model="loginCode"
                            :loading="loginIsLoading"
                            focused
                            focus-all
                            class="mt-3"
                            color="primary"
                        ></v-otp-input>
                    </v-card-text>
                    <v-divider class="mx-4" />
                    <v-card-text>
                        <span>{{ t('settings.sonolus.login_alternative') }}</span><br/>
                        <v-btn 
                            class="mt-3"
                            :disabled="loginIsLoading"
                            :href="getBaseUrl().openInSonolusBaseUrl + '/levels/wbs-auth-' + loginCode"
                            color="primary"
                        >{{ t('global.open_in_sonolus') }}</v-btn>
                    </v-card-text>
                </v-card>
            </div>
        </div>
    </AppScaffold>
</template>
