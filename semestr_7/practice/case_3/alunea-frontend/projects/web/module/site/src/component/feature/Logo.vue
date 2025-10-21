<script setup>
import logoImage from '@/public/img/logo/transparent/logo-rainbow-1024.png'
</script>

<template>
  <!-- Логотип -->
  <div
      class="d-flex align-center text-decoration-none logo-link"
  >
    <RouterLink to="/#home" class="footer-link">
      <v-img
          :src="logoImage"
          alt="Alunea Logo"
          max-width="70"
          min-width="70"
          class="mr-2"
          eager
      />
    </RouterLink>
    <RouterLink to="/#home" class="footer-link">
      <span class="text-h6 font-weight-bold">Alunea</span>
    </RouterLink>
  </div>
</template>

<style scoped>
.logo-link {
  cursor: pointer;
}

.logo-link a {
  color: rgb(var(--v-theme-secondary)) !important;
  text-decoration: none;
}
</style>