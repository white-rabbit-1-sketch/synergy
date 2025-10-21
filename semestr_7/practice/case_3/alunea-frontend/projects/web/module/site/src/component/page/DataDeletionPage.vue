<script setup>
import Header from "@/component/layout/Header.vue";
import Footer from "@/component/layout/Footer.vue";

const supportEmail = import.meta.env.VITE_SUPPORT_EMAIL;
</script>

<template>
  <div class="layout">
    <div class="header">
      <Header />
    </div>

    <div class="content">
      <div class="pa-4 pa-md-16">
        <div class="d-flex justify-center">
          <h2>Data deletion</h2>
        </div>

        <div class="d-flex justify-center">
          <h3>Introduction</h3>
        </div>
        <p>
          You can request deletion of specific personal data associated with your Alunea account at any time, without deleting your account.
          This page explains how to make such a request and what information will be removed.
        </p>

        <div class="d-flex justify-center">
          <h3>How to request data deletion</h3>
        </div>
        <p>
          To request deletion of your data, please send an email to
          <a :href="'mailto:' + supportEmail">{{ supportEmail }}</a>
          from the same email address linked to your Alunea account.
        </p>
        <p>
          In your request, please specify which data you would like us to remove
          (for example, saved words, translations, learning progress, or personal details).
          Our team will review your request and confirm the deletion within 30 days.
        </p>

        <div class="d-flex justify-center">
          <h3>What data can be deleted</h3>
        </div>
        <br />
        <ul style="margin-left: 30px">
          <li>Saved words, phrases, and learning history</li>
          <li>Subscription data (if applicable)</li>
          <li>Personal profile data (upon request)</li>
        </ul>
        <br />

        <div class="d-flex justify-center">
          <h3>What data may be retained</h3>
        </div>
        <p>
          Some transactional or technical data (for example, billing records or system logs)
          may be retained for up to 180 days for legal and accounting purposes,
          after which it will be permanently deleted.
        </p>

        <div class="d-flex justify-center">
          <h3>Verification and security</h3>
        </div>
        <p>
          For security reasons, only requests sent from the same email address
          associated with your Alunea account can be processed.
          This ensures that only the account owner can request deletion of their data.
        </p>

        <div class="d-flex justify-center">
          <h3>Processing time</h3>
        </div>
        <p>
          Data deletion requests are typically processed within 30 days.
          You will receive an email confirmation once the requested data has been removed.
        </p>

        <div class="d-flex justify-center">
          <h3>Note</h3>
        </div>
        <p>
          Requesting data deletion will not delete your account or active subscription.
          If you wish to permanently delete your entire account and all data,
          please visit the
          <RouterLink to="/account-deletion" class="footer-link">Account deletion</RouterLink> page.
        </p>

        <div class="d-flex justify-center">
          <h3>Privacy Policy</h3>
        </div>
        <p>
          For more details, please review our
          <RouterLink to="/privacy-policy" class="footer-link">Privacy Policy</RouterLink>.
        </p>
      </div>
    </div>

    <div class="footer">
      <Footer />
    </div>
  </div>
</template>

<style scoped>
p {
  margin-top: 15px;
  margin-bottom: 15px;
}
</style>
