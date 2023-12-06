<script setup>
import { i18n } from '@/i18n';
import { ref } from "vue";
import {
	isLoading, isError, errorText, getServerInfo, init
} from '@/utils/api.js';
import AppScaffold from "@/components/AppScaffold/AppScaffold.vue";
import LoadingCircle from '@/components/LoadingCircle/LoadingCircle.vue';

const t = i18n.global.t;
const git_repo = ref("");
const git_branch = ref("");
const git_commit = ref("");
const git_message = ref("");
const drive_message = ref("");
const isOK = ref(false);

function round2(n) {
	return Math.round(n * 100) / 100;
}
function sizeToString(size) {
	if (size < 1024) return size + "B";
	size /= 1024; if (size < 1024) return round2(size) + "KB";
	size /= 1024; if (size < 1024) return round2(size) + "MB";
	size /= 1024; if (size < 1024) return round2(size) + "GB";
	size /= 1024; return round2(size) + "TB";
}
async function loading() {
	init();
	var res = await getServerInfo();
	drive_message.value = 
		sizeToString(res.drive.used) + " / " + sizeToString(res.drive.total) +
		" (" + round2(res.drive.used / res.drive.total * 100) + "%)";
	git_repo.value = res.git.owner + " / " + res.git.repo;
	git_branch.value = res.git.branch;
	git_commit.value = res.git.commit;
	git_message.value = res.git.commit_message;
	isLoading.value = false;
	isOK.value = true;
}
loading();

const serverInfoList = [{
		title: "git",
		icon: "mdi-git",
		items: [
			{ "label": "git_repo", "model": git_repo },
			{ "label": "git_branch", "model": git_branch },
			{ "label": "git_commit", "model": git_commit },
			{ "label": "git_message", "model": git_message }
		]
	}, {
		title: "drive",
		icon: "mdi-server",
		items: [
			{ "label": "drive_message", "model": drive_message },
		]
	}
]
</script>

<template>
	<AppScaffold>
		<LoadingCircle v-if="isLoading"></LoadingCircle>
		<v-snackbar v-model="isError">
			{{ errorText }}
			<template v-slot:actions>
				<v-btn color="primary" @click="isError = false">{{ t('global.close') }}</v-btn>
			</template>
		</v-snackbar>
		<div class="d-flex gap-2" v-if="isOK">
			<v-card :title="t('home.server_info')" class="flex-grow-1">
				<div v-for="(item, index) in serverInfoList">
                	<v-divider class="mx-4" v-if="index != 0" />
					<v-card-text>
		                <span>
		                    <v-icon size="small" :icon="item.icon" class="mr-1"></v-icon>
		                    <span>{{ t('home.server_info_' + item.title) }}</span>
		                </span>
		                <v-text-field
		                	v-for="it in item.items"
		                	:model-value="it.model"
		                	:label="t('home.server_info_' + it.label)"
   							density="compact"
   							variant="outlined"
   							focused
   							disabled
   							hide-details
   							class="mt-3"
		                ></v-text-field>
		            </v-card-text>
		        </div>
			</v-card>
		</div>
	</AppScaffold>
</template>
