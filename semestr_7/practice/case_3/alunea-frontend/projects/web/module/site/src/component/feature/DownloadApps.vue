<script setup>

import googleDownloadImage from '@/public/img/google-download-badge-black.png'
import appleDownloadImage from '@/public/img/apple-download-badge-white.svg'
import chromeImage from '@/public/img/browser/chrome.svg'
import braveImage from '@/public/img/browser/brave.svg'
import firefoxImage from '@/public/img/browser/firefox.svg'
import operaImage from '@/public/img/browser/opera.svg'
import edgeImage from '@/public/img/browser/edge.svg'
import orionImage from '@/public/img/browser/orion.png'
import safariImage from '@/public/img/browser/safari.svg'

const appStoreUrl = import.meta.env.VITE_APP_STORE_URL;
const googlePlayUrl = import.meta.env.VITE_GOOGLE_PLAY_URL;
const chromeStoreUrl = import.meta.env.VITE_CHROME_STORE_URL;
const safariStoreUrl = import.meta.env.VITE_SAFARI_STORE_URL;
</script>

<template>
  <v-row no-gutters>
    <!-- Google Play -->
    <v-col cols="12" sm="auto" class="me-sm-4 mb-4 mb-sm-0">
      <template v-if="googlePlayUrl">
        <a :href="googlePlayUrl" target="_blank">
          <v-img
              :src="googleDownloadImage"
              alt="Get it on Google Play"
              max-width="150"
              min-width="150"
              class="pointer"
              eager
          />
        </a>
      </template>
      <template v-else>
        <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
          <template #activator="{ props }">
            <v-img
                :src="googleDownloadImage"
                alt="Get it on Google Play"
                max-width="150"
                min-width="150"
                class="pointer"
                v-bind="props"
                eager
            />
          </template>
        </v-tooltip>
      </template>
    </v-col>

    <!-- App Store -->
    <v-col cols="12" sm="auto">
      <template v-if="appStoreUrl">
        <a :href="appStoreUrl" target="_blank">
          <v-img
              :src="appleDownloadImage"
              alt="Download on App Store"
              max-width="150"
              min-width="150"
              class="pointer"
              eager
          />
        </a>
      </template>
      <template v-else>
        <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
          <template #activator="{ props }">
            <v-img
                :src="appleDownloadImage"
                alt="Download on App Store"
                max-width="150"
                min-width="150"
                class="pointer"
                v-bind="props"
                eager
            />
          </template>
        </v-tooltip>
      </template>
    </v-col>
  </v-row>




  <div class="d-flex flex-wrap mt-4 gap-4">
    <template v-if="chromeStoreUrl">
      <v-btn icon :href="chromeStoreUrl" target="_blank">
        <v-img :src="chromeImage" alt="Chrome" width="32" height="32" eager />
      </v-btn>

      <v-btn class="ml-2" icon :href="chromeStoreUrl" target="_blank">
        <v-img :src="braveImage" alt="Brave" width="32" height="32"  eager/>
      </v-btn>

      <v-btn class="ml-2" icon :href="chromeStoreUrl" target="_blank">
        <v-img :src="firefoxImage" alt="Firefox" width="32" height="32" eager />
      </v-btn>

      <v-btn class="ml-2" icon :href="chromeStoreUrl" target="_blank">
        <v-img :src="operaImage" alt="Opera" width="32" height="32" eager />
      </v-btn>

      <v-btn class="ml-2" icon :href="chromeStoreUrl" target="_blank">
        <v-img :src="edgeImage" alt="Edge" width="32" height="32" eager />
      </v-btn>

        <v-btn class="ml-2" icon :href="chromeStoreUrl" target="_blank">
          <v-img :src="orionImage" alt="Orion" width="32" height="32" eager />
        </v-btn>
    </template>
    <template v-else>
      <!-- Chrome -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn v-bind="props" icon target="_blank">
            <v-img :src="chromeImage" alt="Chrome" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>

      <!-- Brave -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn class="ml-2" v-bind="props" icon target="_blank">
            <v-img :src="braveImage" alt="Brave" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>

      <!-- Firefox -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn class="ml-2" v-bind="props" icon target="_blank">
            <v-img :src="firefoxImage" alt="Firefox" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>

      <!-- Opera -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn class="ml-2" v-bind="props" icon target="_blank">
            <v-img :src="operaImage" alt="Opera" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>

      <!-- Edge -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn class="ml-2" v-bind="props" icon target="_blank">
            <v-img :src="edgeImage" alt="Edge" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>

      <!-- Orion -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn class="ml-2" v-bind="props" icon target="_blank">
            <v-img :src="orionImage" alt="Orion" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>
    </template>

    <template v-if="safariStoreUrl">
      <v-btn class="ml-2" icon :href="safariStoreUrl" target="_blank">
        <v-img :src="safariImage" alt="Safari" width="32" height="32" eager />
      </v-btn>
    </template>
    <template v-else>
      <!-- Safari -->
      <v-tooltip text="Coming soon" location="top" open-on-hover open-on-click>
        <template #activator="{ props }">
          <v-btn class="ml-2" v-bind="props" icon>
            <v-img :src="safariImage" alt="Safari" width="32" height="32" eager />
          </v-btn>
        </template>
      </v-tooltip>
    </template>
  </div>
</template>

<style scoped>
.pointer {
  cursor: pointer;
}
</style>