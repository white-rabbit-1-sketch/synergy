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
      <section class="about pa-4 pa-md-16">
        <h1 class="text-h3 font-weight-bold text-center mb-8">
          About Us
        </h1>
        <p class="text-body-1 text-center mb-6">
          Alunea is a language-learning ecosystem built around real context.
          We combine technology, design, and the love of languages to make learning simple and inspiring.
        </p>
        <p class="text-body-1 text-center mb-12">
          Our browser extension helps you watch movies and shows with dual subtitles,
          while the mobile app turns new words and phrases into interactive flashcards you can review anytime.
        </p>

        <!-- Values Cards -->
        <v-row dense justify="center" class="values mb-16">
          <v-col cols="12" sm="4" class="d-flex">
            <v-card flat class="value-card pa-6 flex-grow-1 text-center">
              <v-icon size="40" color="cyan" class="mb-4" :icon="mdiLightbulbOn" />
              <h3 class="text-h6 font-weight-bold mb-2">Smart Translation</h3>
              <p class="text-body-2">
                Context-aware AI translations of words and phrases for deeper understanding.
              </p>
            </v-card>
          </v-col>

          <v-col cols="12" sm="4" class="d-flex">
            <v-card flat class="value-card pa-6 flex-grow-1 text-center">
              <v-icon size="40" color="purple" class="mb-4" :icon="mdiMovieOpen" />
              <h3 class="text-h6 font-weight-bold mb-2">Learn with Movies</h3>
              <p class="text-body-2">
                Improve your language skills while watching your favorite shows and films.
              </p>
            </v-card>
          </v-col>

          <v-col cols="12" sm="4" class="d-flex">
            <v-card flat class="value-card pa-6 flex-grow-1 text-center">
              <v-icon size="40" color="teal" class="mb-4" :icon="mdiSchool" />
              <h3 class="text-h6 font-weight-bold mb-2">Fun & Engaging</h3>
              <p class="text-body-2">
                Bright design and gamification turn language learning into an adventure.
              </p>
            </v-card>
          </v-col>
        </v-row>

        <!-- Values -->
        <section class="company-values mb-16">
          <h2 class="text-h5 font-weight-bold text-center mb-6 text-gradient">
            Our Values
          </h2>
          <v-row justify="center" class="text-center">
            <v-col cols="12" md="4">
              <h3 class="text-h6 font-weight-bold mb-2">Privacy First</h3>
              <p class="text-body-2">
                Your data belongs to you. We design our services with transparency
                and full respect for your privacy.
              </p>
            </v-col>
            <v-col cols="12" md="4">
              <h3 class="text-h6 font-weight-bold mb-2">Honesty & Trust</h3>
              <p class="text-body-2">
                No hidden tricks or misleading features. We aim to be clear,
                fair, and open with our community.
              </p>
            </v-col>
            <v-col cols="12" md="4">
              <h3 class="text-h6 font-weight-bold mb-2">Creativity & Joy</h3>
              <p class="text-body-2">
                Learning should inspire curiosity and spark joy —
                an adventure rather than a chore.
              </p>
            </v-col>
          </v-row>
        </section>

        <!-- Promise -->
        <section class="promise">
          <h2 class="text-h5 font-weight-bold text-center mb-6 text-gradient">
            Our Promise
          </h2>
          <p class="text-body-1 text-center">
            We’re committed to building tools that empower learners, respect their time,
            and keep them motivated. With Alunea, you’re not just learning words —
            you’re connecting with cultures, people, and stories around the world.
          </p>
        </section>
      </section>
    </div>
  </div>

  <div class="footer">
    <Footer />
  </div>
</template>

<style scoped>
.about {
  max-width: 960px;
  margin: 0 auto;
}

.text-body-1 {
  color: rgb(var(--v-theme-secondary)) !important;
}
</style>
