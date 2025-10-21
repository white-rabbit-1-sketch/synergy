<script setup>
import {
  mdiSubtitles,
  mdiCellphone,
  mdiTranslate,
  mdiBookmarkMultiple,
  mdiChartBar,
  mdiPuzzle,
} from "@mdi/js"
import Header from "@/component/layout/Header.vue";
import Footer from "@/component/layout/Footer.vue";
import DownloadApps from "@/component/feature/DownloadApps.vue";
import banner1Image from '@/public/img/banner-1.png'
import banner2Image from '@/public/img/banner-2.png'
import banner3Image from '@/public/img/banner-3.png'
import banner4Image from '@/public/img/banner-4.png'
import banner5Image from '@/public/img/banner-5.png'
import banner6Image from '@/public/img/banner-6.png'
import banner7Image from '@/public/img/banner-7.png'
</script>

<template>
  <div class="layout anchor" id="home">
    <div class="header">
      <Header />
    </div>
    <div class="content pl-0 pr-0">
      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-0">
          <v-row align="center" justify="space-between" no-gutters>
            <v-col cols="12" md="6">
              <h1 class="font-weight-bold mb-6 general-title text-h4 text-md-h3 text-lg-h2">
                The next-gen language learning platform
              </h1>
              <p class="text-body-1 mb-8">
                Alunea helps you learn languages while watching your favorite shows — with dual subtitles,
                AI translations, and smart vocabulary tools that turn entertainment into effortless learning.
              </p>

              <DownloadApps />
            </v-col>

            <v-col cols="12" md="6" class="mt-10 mt-md-0 d-flex justify-center justify-md-end">
              <div class="banner-wrapper">
                <v-img
                    :src="banner1Image"
                    alt="App Screenshot"
                    class="w-100"
                    eager
                />
              </div>
            </v-col>

          </v-row>
      </section>

      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16 hero-section">
        <v-row align="center" justify="center" no-gutters>
          <v-col cols="6" md="3" class="text-center">
            <p class="text-h2 font-weight-bold">50+</p>
            <p class="text-subtitle-1">Languages supported</p>
          </v-col>

          <v-col cols="6" md="3" class="text-center">
            <p class="text-h2 font-weight-bold">57k</p>
            <p class="text-subtitle-1">Words discovered</p>
          </v-col>

          <v-col cols="6" md="3" class="text-center">
            <p class="text-h2 font-weight-bold">83k</p>
            <p class="text-subtitle-1">Phrases discovered</p>
          </v-col>
        </v-row>
      </section>

      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16 anchor" id="features">
        <v-row no-gutters justify="center">
          <div class="font-weight-bold mb-6 text-h5 text-sm-h4 text-md-h3 text-lg-h2">
            Smart features designed for modern learners
          </div>
        </v-row>

        <v-row align="stretch" justify="center" dense>
          <!-- Левая колонка -->
          <v-col cols="12" md="3">
            <v-row dense>
              <v-col cols="12">
                <v-card outlined class="pa-6 h-100 text-center">
                  <v-icon size="40" class="mb-4" :icon="mdiSubtitles" />
                  <h3 class="text-h6 font-weight-bold mb-2">Dual Subtitles</h3>
                  <p class="text-body-2">
                    Watch movies and shows with two subtitle tracks at once — original and translated.
                  </p>
                </v-card>
              </v-col>
              <v-col cols="12">
                <v-card outlined class="pa-6 h-100 text-center">
                  <v-icon size="40" class="mb-4" :icon="mdiBookmarkMultiple" />
                  <h3 class="text-h6 font-weight-bold mb-2">Smart Vocabulary</h3>
                  <p class="text-body-2">
                    Save words and phrases into your personal vocabulary and revisit them anytime.
                  </p>
                </v-card>
              </v-col>
              <v-col cols="12">
                <v-card outlined class="pa-6 h-100 text-center">
                  <v-icon size="40" class="mb-4" :icon="mdiChartBar" />
                  <h3 class="text-h6 font-weight-bold mb-2">Track Progress</h3>
                  <p class="text-body-2">
                    Monitor your learning journey — see how many words you’ve learned and stay motivated.
                  </p>
                </v-card>
              </v-col>
            </v-row>
          </v-col>

          <!-- Центральная колонка -->
          <v-col cols="12" md="6">
            <v-card class="pa-6 h-100 text-center featured-card d-flex flex-column justify-center">
              <h3 class="text-h6 font-weight-bold mb-2">iOS & Android App</h3>
              <p class="text-body-2 mb-6">
                A powerful mobile app for smooth and immersive learning — also available as a browser extension, web app, and installable PWA.
              </p>
              <div class="d-flex justify-center">
                <div class="banner-wrapper">
                  <v-img
                      :src="banner2Image"
                      alt="App Screenshot"
                      class="w-100"
                      eager
                  />
                </div>
              </div>
            </v-card>
          </v-col>

          <!-- Правая колонка -->
          <v-col cols="12" md="3">
            <v-row dense>
              <v-col cols="12">
                <v-card outlined class="pa-6 h-100 text-center">
                  <v-icon size="40" class="mb-4" :icon="mdiTranslate" />
                  <h3 class="text-h6 font-weight-bold mb-2">On-the-fly Translations</h3>
                  <p class="text-body-2">
                    Instantly generate translations when your show has no subtitles in your language.
                  </p>
                </v-card>
              </v-col>
              <v-col cols="12">
                <v-card outlined class="pa-6 h-100 text-center">
                  <v-icon size="40" class="mb-4" :icon="mdiPuzzle" />
                  <h3 class="text-h6 font-weight-bold mb-2">Browser Extensions</h3>
                  <p class="text-body-2">
                    Watch your favorite streaming platforms with dual subtitles — right in your browser.
                  </p>
                </v-card>
              </v-col>
              <v-col cols="12">
                <v-card outlined class="pa-6 h-100 text-center">
                  <v-icon size="40" class="mb-4" :icon="mdiTranslate" />
                  <h3 class="text-h6 font-weight-bold mb-2">Contextual AI Translations</h3>
                  <p class="text-body-2">
                    Get instant AI-powered translations with context-aware meaning and examples.
                  </p>
                </v-card>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </section>

      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16 section-blur anchor" id="about">
        <v-row align="center" justify="space-between" no-gutters>
          <v-col cols="12" md="6" class="mt-10 mt-md-0 d-flex justify-center justify-md-start">
            <div class="banner-wrapper">
              <v-img
                  :src="banner4Image"
                  alt="App Screenshot"
                  class="w-100"
                  eager
              />
            </div>
          </v-col>
          <v-col cols="12" md="6">
            <h1 class="font-weight-bold mb-6 text-h5 text-sm-h4 text-md-h3 text-lg-h2">
              Learn languages while watching your favorite shows
            </h1>
            <p class="text-body-1 mb-8">
              Alunea turns video streaming platforms into your personal
              language tutor. Enjoy dual subtitles, AI translations, and smart
              vocabulary tools — all without leaving the video.
            </p>
            <p class="text-body-1 mb-8">
              Whether you’re re-watching your favorite series or exploring new content,
              Alunea helps you pick up new words and phrases naturally, while you’re
              entertained.
            </p>

            <DownloadApps />
          </v-col>
        </v-row>
      </section>

      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16 anchor">
        <v-row align="center" justify="space-between" no-gutters>
          <v-col cols="12" md="6">
            <h1 class="font-weight-bold mb-6 text-h5 text-sm-h4 text-md-h3 text-lg-h2">
              Smart AI-powered vocabulary recommendations
            </h1>
            <p class="text-body-1 mb-6">
              Alunea adapts to your level and learning progress, analyzing your journey
              and recommending the most relevant words and phrases. It’s like having
              a personal language coach, guiding you every step of the way.
            </p>
            <p class="text-body-1 mb-10">
              Alunea doesn’t just suggest random vocabulary — it selects words that fit
              your current skills, interests, and the shows you watch. This means you
              learn the right words at the right time, making every new addition to
              your vocabulary natural, memorable, and effective.
            </p>
            <p class="text-body-1 mb-10">
              Whether you’re just starting out or aiming for fluency, Alunea ensures
              your vocabulary grows in the smartest way possible — always tailored to
              your pace, always keeping you motivated. Learn smarter, not harder.
            </p>
          </v-col>

          <!-- Правая часть: картинка -->
          <v-col cols="12" md="6" class="mt-10 mt-md-0 d-flex justify-center justify-md-end">
            <div class="banner-wrapper">
              <v-img
                  :src="banner6Image"
                  alt="App Screenshot"
                  class="w-100"
                  eager
              />
            </div>
          </v-col>
        </v-row>
      </section>

      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16 anchor">
        <v-row align="center" justify="space-between" no-gutters>
          <v-col cols="12" md="6">
            <h1 class="font-weight-bold mb-6 text-h5 text-sm-h4 text-md-h3 text-lg-h2">
              Everything you need for effortless learning
            </h1>
            <p class="text-body-1 mb-10">
              Alunea combines subtitles, AI and smart tools to make language learning
              simple and enjoyable — directly while you watch.
            </p>

            <!-- Список с иконками -->
            <div class="d-flex mb-6">
              <v-icon color="primary" class="mr-4" :icon="mdiSubtitles" />
              <div>
                <h3 class="text-h6 font-weight-bold mb-1">Dual Subtitles</h3>
                <p class="text-body-2">
                  Watch with two subtitle tracks — original and translated — for natural immersion.
                </p>
              </div>
            </div>

            <div class="d-flex mb-6">
              <v-icon color="primary" class="mr-4" :icon="mdiTranslate" />
              <div>
                <h3 class="text-h6 font-weight-bold mb-1">AI Translations</h3>
                <p class="text-body-2">
                  Get instant, context-aware translations when subtitles aren’t available in your language.
                </p>
              </div>
            </div>

            <div class="d-flex mb-6">
              <v-icon color="primary" class="mr-4" :icon="mdiBookmarkMultiple" />
              <div>
                <h3 class="text-h6 font-weight-bold mb-1">Smart Vocabulary</h3>
                <p class="text-body-2">
                  Save words and phrases into your personal word bank and review them anytime.
                </p>
              </div>
            </div>

            <div class="d-flex">
              <v-icon color="primary" class="mr-4" :icon="mdiCellphone" />
              <div>
                <h3 class="text-h6 font-weight-bold mb-1">Cross-platform</h3>
                <p class="text-body-2">
                  Use the browser extension or mobile app — your progress and vocabulary stay in sync.
                </p>
              </div>
            </div>
          </v-col>

          <!-- Правая часть: картинка -->
          <v-col cols="12" md="6" class="mt-10 mt-md-0 d-flex justify-center justify-md-end">
            <div class="banner-wrapper">
              <v-img
                  :src="banner3Image"
                  alt="App Screenshot"
                  class="w-100"
                  eager
              />
            </div>
          </v-col>
        </v-row>
      </section>




      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16">
        <v-row align="center" justify="space-between" no-gutters>
          <v-col cols="12" md="6" class="mt-10 mt-md-0 d-flex justify-center justify-md-start">
            <div class="banner-wrapper">
              <v-img
                  :src="banner7Image"
                  alt="App Screenshot"
                  class="w-100"
                  eager
              />
            </div>
          </v-col>
          <v-col cols="12" md="6">
            <h1 class="font-weight-bold mb-6 text-h5 text-sm-h4 text-md-h3 text-lg-h2">
              One platform, all your devices
            </h1>
            <p class="text-body-1 mb-8">
              Alunea is with you wherever you choose to learn. Seamlessly switch from watching movies
              with dual subtitles in your browser, to practicing vocabulary on your phone — the very
              same app powers it all.
            </p>
            <p class="text-body-1 mb-8">
              Every word you save, every phrase you discover, every step in your progress stays
              instantly synchronized. No matter the screen, your learning journey is always
              connected and ready to continue.
            </p>
          </v-col>
        </v-row>
      </section>


      <section class="pl-4 pr-4 pl-md-16 pr-md-16 pb-16 pt-16 mt-16 faq-section anchor" id="faq">
        <!-- Заголовок -->
        <v-row justify="center" class="mb-10">
          <h1 class="font-weight-bold mb-6 text-h5 text-sm-h4 text-md-h3 text-lg-h2 text-center">
            Frequently Asked Questions
          </h1>
        </v-row>

        <!-- Два столбца с вопросами -->
        <v-row>
          <!-- Левая колонка -->
          <v-col cols="12" md="6">
            <v-expansion-panels multiple>
              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  How does Alunea work?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Alunea is a browser extension and mobile app that turn watching movies
                  into language learning. When you watch videos on your favorite streaming platform
                  with the extension enabled, it automatically adds dual subtitles: original and translated.
                  Alunea analyzes subtitles in real time and provides detailed linguistic insights.
                  You can click on any word or phrase to get its meaning, usage, and context - and
                  optionally save it. Everything you save becomes available in the Alunea mobile app,
                  where you can study words and phrases, track your progress, filter by language, level,
                  and more.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  Which streaming platforms does Alunea support?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Currently, Alunea supports only Netflix. We're working on adding support for YouTube,
                  Prime Video, Disney+, and others. If there's a specific platform you need,
                  feel free to email us.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  Which browsers does Alunea support?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Alunea currently supports Chrome, Brave, Firefox, Opera, Edge, Orion, and Safari on desktop. On mobile devices, official support is available only for Safari. Other mobile browsers do not yet provide full extension support, which makes integration technically impossible for now. We're closely monitoring browser updates, and as soon as proper mobile extension support becomes available, Alunea will be adapted immediately.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  Is there a free version?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  We believe language learning should be accessible to everyone.
                  Many features are completely free and don't require a subscription - such as dual subtitles,
                  word info, translations, and more.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  What does the Premium subscription offer?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Premium enhances existing features and adds new ones. For example, the free version gives you basic word translations, while Premium adds contextual translations for greater accuracy. Premium also enables subtitle translation on-the-fly - even when the streaming service has no translations. Saving and analyzing words and phrases without limits is also available only in Premium.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  Do you offer refunds?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  If you're unhappy or need a refund for any reason, please request it directly via the platform where you made the purchase (Apple or Google).
                </v-expansion-panel-text>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-col>

          <!-- Правая колонка -->
          <v-col cols="12" md="6">
            <v-expansion-panels multiple>
              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  Do I need both the extension and the app?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Not necessarily. The extension is great for learning while watching
                  shows on desktop, while the mobile app helps you review and practice
                  on the go. They work best together.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  Which languages are supported?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Alunea supports 50+ languages.
                  You can mix and match to learn in the way that fits you best.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  I installed the app, but nothing works. What should I do?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  In addition to the mobile app, you also need the browser extension installed.
                  Once both are set up, all features become available.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  I’m having issues with my subscription. What should I do?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  Please contact us directly if you’re experiencing subscription-related issues —
                  we’ll help resolve them as quickly as possible.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  How can I delete my account and data?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  If you want to delete your account and all data linked to it,
                  simply email us and we’ll process your request.
                </v-expansion-panel-text>
              </v-expansion-panel>

              <v-expansion-panel>
                <v-expansion-panel-title class="text-h6 font-weight-medium">
                  How to add words and phrases?
                </v-expansion-panel-title>
                <v-expansion-panel-text class="text-body-2">
                  On desktop, simply click on a word or phrase to add or mark it as studied,
                  depending on its current state. Hover over a word to view detailed information.
                  On mobile or tablet, a quick tap shows info, while a long press changes its state
                  (adds it to study or marks as studied).
                </v-expansion-panel-text>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-col>
        </v-row>
      </section>


    </div>

    <div class="footer">
      <Footer />
    </div>
  </div>
</template>

<style scoped>
.general-title {
  font-family: "DM Sans", sans-serif;
}

.section-spacer {
  margin-top: 100px;
}

.text-body-1 {
  color: rgb(var(--v-theme-secondary)) !important;
}

.hero-section, .faq-section {
  background-color: rgb(var(--v-theme-secondary)) !important;
  color: rgb(var(--v-theme-body-1)) !important;
}

:deep(.faq-section .v-expansion-panel) {
  background-color: rgb(var(--v-theme-secondary)) !important;
  color: rgb(var(--v-theme-body-1)) !important;
}

.section-blur {

  backdrop-filter: blur(6px);
  border-radius: 16px;
}
</style>