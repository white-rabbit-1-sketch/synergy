<script setup>
import {
  mdiTwitter,
  mdiFacebook,
  mdiInstagram,
  mdiLinkedin,
  mdiReddit
} from "@mdi/js"
import Logo from "@/component/feature/Logo.vue";
import DownloadApps from "@/component/feature/DownloadApps.vue";

const supportEmail = import.meta.env.VITE_SUPPORT_EMAIL;
const currentYear = new Date().getFullYear();
</script>

<template>
  <section class="pa-4 pa-md-16">
    <v-row>
      <!-- Лого + описание -->
      <v-col cols="12" md="3">
        <div class="d-flex align-center mb-4">
          <Logo />
        </div>
        <p class="text-body-2">
          Alunea turns your favorite shows into a fun and effortless way to learn languages.
          Watch, translate, and grow your vocabulary every day.
        </p>

        <!-- Соцсети -->
        <div class="d-flex mt-4">
          <!-- Reddit -->
          <v-btn icon variant="plain" href="https://reddit.com" target="_blank" disabled>
            <v-icon :icon="mdiReddit" color="#FF4500" />
          </v-btn>

          <!-- Twitter (X) -->
          <v-btn icon variant="plain" href="https://twitter.com" target="_blank" disabled>
            <v-icon :icon="mdiTwitter" color="#1DA1F2" />
          </v-btn>

          <!-- Facebook -->
          <v-btn icon variant="plain" href="https://facebook.com" target="_blank" disabled>
            <v-icon :icon="mdiFacebook" color="#1877F2" />
          </v-btn>

          <!-- Instagram -->
          <v-btn icon variant="plain" href="https://instagram.com" target="_blank" disabled>
            <v-icon :icon="mdiInstagram" color="#E4405F" />
          </v-btn>

          <!-- LinkedIn -->
          <v-btn icon variant="plain" href="https://linkedin.com" target="_blank" disabled>
            <v-icon :icon="mdiLinkedin" color="#0A66C2" />
          </v-btn>
        </div>

      </v-col>

      <!-- Company -->
      <v-col cols="12" md="2">
        <h3 class="text-subtitle-1 font-weight-bold mb-4">Company</h3>
        <ul class="footer-list">
          <li>
            <RouterLink to="/about-us" class="footer-link">About Us</RouterLink>
          </li>
          <li><a :href="'mailto:' + supportEmail">Support</a></li>
          <li>
            <RouterLink to="/privacy-policy" class="footer-link">Privacy Policy</RouterLink>
          </li>
          <li>
            <RouterLink to="/terms-of-use" class="footer-link">Terms & Conditions</RouterLink>
          </li>
        </ul>
      </v-col>

      <!-- Resources -->
      <v-col cols="12" md="2">
        <h3 class="text-subtitle-1 font-weight-bold mb-4">Resources</h3>
        <ul class="footer-list">
          <li>
            <RouterLink to="/#faq">FAQ</RouterLink>
          </li>
          <li>
            <RouterLink to="/account-deletion" class="footer-link">Account deletion</RouterLink>
          </li>
          <li>
            <RouterLink to="/data-deletion" class="footer-link">Data deletion</RouterLink>
          </li>
        </ul>
      </v-col>

      <!-- Downloads -->
      <v-col cols="12" md="5">
        <h3 class="text-subtitle-1 font-weight-bold mb-4">Get Alunea</h3>
        <DownloadApps />
      </v-col>
    </v-row>

    <!-- Нижняя полоса -->
    <v-row>
      <v-col cols="12" class="text-center text-body-2">
        © {{currentYear}} Alunea.
      </v-col>
    </v-row>
  </section>
</template>

<style scoped>
.footer-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-list li {
  margin-bottom: 8px;
}

.footer-list a {
  color: rgb(var(--v-theme-secondary), 0.8);
  text-decoration: none;
  transition: color 0.2s;
}

.footer-list a:hover {
  color: rgb(var(--v-theme-secondary));
}
</style>
