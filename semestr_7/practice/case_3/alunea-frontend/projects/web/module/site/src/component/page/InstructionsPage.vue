<script setup>
import {
  mdiLightbulbOn,
  mdiMovieOpen,
  mdiSchool,
} from "@mdi/js"
import Header from "@/component/layout/Header.vue";
import Footer from "@/component/layout/Footer.vue";
</script>

<template>
  <div class="layout">
    <div class="header">
      <Header />
    </div>

    <div class="content">
      <section class="pa-4 pa-md-16">

      </section>
    </div>
  </div>

  <div class="footer">
    <Footer />
  </div>
</template>

<style scoped>
.text-body-1 {
  color: rgb(var(--v-theme-secondary)) !important;
}
</style>
