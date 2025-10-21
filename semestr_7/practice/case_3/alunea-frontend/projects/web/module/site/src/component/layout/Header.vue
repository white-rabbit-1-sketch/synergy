<script setup>
import { mdiMenu } from "@mdi/js"
import { ref } from "vue"
import Logo from "@/component/feature/Logo.vue";
import {useRouter} from "vue-router";

const router = useRouter();
const supportEmail = import.meta.env.VITE_SUPPORT_EMAIL;
const appUrl = import.meta.env.VITE_APP_URL;

const drawer = ref(false);
</script>

<template>
  <v-app-bar flat class="pa-3 app-bar">
    <v-btn icon @click="drawer = !drawer" class="d-md-none">
      <v-icon :icon="mdiMenu" />
    </v-btn>
    <v-spacer class="d-md-none" />

    <Logo />

    <!-- Меню по центру -->
    <div class="d-none d-md-flex align-center justify-center flex-grow-1">
      <v-btn variant="text" size="large" class="mx-3 font-weight-medium desktop-menu-link" @click="router.push('/#home')">
        Home
      </v-btn>
      <v-btn variant="text" size="large" class="mx-3 font-weight-medium desktop-menu-link" @click="router.push('/#features')">
        Features
      </v-btn>
      <v-btn variant="text" size="large" class="mx-3 font-weight-medium desktop-menu-link" @click="router.push('/#about')">
        About
      </v-btn>
      <v-btn variant="text" size="large" class="mx-3 font-weight-medium desktop-menu-link" @click="router.push('/#faq')">
        Faq
      </v-btn>
    </div>


    <!-- Контакт справа -->
    <v-btn
        :href="appUrl"
        target="_blank"
        class="d-none d-md-flex ml-6 px-6 font-weight-bold contact-btn"
    >
      Web version
    </v-btn>
  </v-app-bar>

  <!-- Drawer для мобильного меню -->
  <v-navigation-drawer v-model="drawer" location="left" temporary class="pt-4">
    <v-list>
      <v-list-item class="mobile-menu-link" to="/#home">
        <v-list-item-title class="pl-3 pr-3">Home</v-list-item-title>
      </v-list-item>
      <v-list-item class="mobile-menu-link" to="/#features">
        <v-list-item-title class="pl-3 pr-3">Features</v-list-item-title>
      </v-list-item>
      <v-list-item class="mobile-menu-link" to="/#about">
        <v-list-item-title class="pl-3 pr-3">About</v-list-item-title>
      </v-list-item>
      <v-list-item class="mobile-menu-link" to="/#faq">
        <v-list-item-title class="pl-3 pr-3">FAQ</v-list-item-title>
      </v-list-item>
      <v-list-item :href="appUrl" target="_blank">
        <v-list-item-title class="pl-3 pr-3">Web version</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<style scoped>
:deep(.mobile-menu-link .v-list-item__overlay) {
  background-color: rgb(var(--v-theme-body-1)) !important;
}

:deep(.desktop-menu-link .v-btn__content) {
  color: rgb(var(--v-theme-secondary)) !important;
}



.text-body-1 {
  color: rgb(var(--v-theme-secondary)) !important;
}

/* выделяющаяся кнопка */
.contact-btn {
  background: linear-gradient(90deg, #ff8c00, #ff3d00, #ff0080);
  color: white !important;
  border-radius: 999px;
}
</style>
