<script setup>
import {RouterView, useRouter} from 'vue-router';
import {container} from "@/container";
import {onMounted} from "vue";
import i18n from "../../../../common/src/i18n";
import {LanguageService} from "../../../../common/src/service/language-service";
import {useI18n} from "vue-i18n";
import {ThemeService} from "../../../../common/src/service/theme-service";
import {useTheme} from "vuetify";
import {RouterService} from "../../../../common/src/service/router-service.js";

const languageService = container.get(LanguageService);
const themeService = container.get(ThemeService);
const routerService = container.get(RouterService);
themeService.init(useTheme());
routerService.init(useRouter());

const { t } = useI18n();

async function updateLocale() {
  if (import.meta.env.VITE_USE_LOCALES) {
    i18n.global.locale = languageService.getNavigatorLanguageVariant()?.getLanguage()?.getCode() ??
        languageService.getDefaultLanguage().getCode();
  }
}

onMounted(async () => {
  await updateLocale();
});
</script>

<template>
  <RouterView />
</template>