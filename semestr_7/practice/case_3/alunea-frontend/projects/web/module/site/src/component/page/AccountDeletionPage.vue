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
          <h2>Account deletion</h2>
        </div>
        <div class="d-flex justify-center">
          <h3>Introduction</h3>
        </div>
        <p>
          You can request deletion of your Alunea account and all associated data at any time.
        </p>

        <div class="d-flex justify-center">
          <h3>How to request deletion</h3>
        </div>
        <p>
          To delete your account, please send an email to <a :href="'mailto:' + supportEmail">{{supportEmail}}</a> from the same email address that is linked to your Alunea account.
        </p>
        <p>
          Your request will be verified, and your account and associated data will be deleted within 30 days.
        </p>

        <div class="d-flex justify-center">
          <h3>What data will be deleted</h3>
        </div>
        <br />
        <ul style="margin-left: 30px">
          <li>Your account information (email, user ID)</li>
          <li>Saved words, phrases, and learning history</li>
          <li>Subscription data (if applicable)</li>
        </ul>
        <br />

        <div class="d-flex justify-center">
          <h3>What data may be retained</h3>
        </div>
        <p>
          Some transaction or billing records may be kept for up to 180 days for legal and accounting purposes, as required by applicable laws.
          After that period, they are permanently deleted.
        </p>

        <div class="d-flex justify-center">
          <h3>Verification and security</h3>
        </div>
        <p>
          For security reasons, we can only process deletion requests sent from the same email address associated with your Alunea account.
          This ensures that only the account owner can request data deletion.
        </p>
        <p>
          All deletion requests are handled manually by our support team to prevent unauthorized access or accidental loss of data.
        </p>

        <div class="d-flex justify-center">
          <h3>After deletion</h3>
        </div>
        <p>
          Once your account is deleted, you will no longer be able to access your saved words, translations, or any personalized data.
          You can create a new Alunea account at any time, but previously deleted data cannot be recovered.
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
  </div>
  <div class="footer">
    <Footer />
  </div>
</template>

<style scoped>
p {
  margin-top: 15px;
  margin-bottom: 15px;
}
</style>
