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
          <h2>Privacy Policy</h2>
        </div>
        <div class="d-flex justify-center">
          <h3>Introduction</h3>
        </div>

        <p>
          This Privacy Policy applies to the Alunea browser extension, mobile app, and related services ("Services").
          By accessing or using Alunea (browser extension, mobile app, or related services), you automatically agree to these Privacy Policy and our Terms of Use.
          If you do not agree, please stop using Alunea immediately.
        </p>

        <div class="d-flex justify-center">
          <h3>TL;DR (Straightforward Version)</h3>
        </div>

        <br />
        <ul style="margin-left: 30px">
          <li>What we collect — only the basics: email, password (hashed), social login ID, subscription info, and words/phrases you choose to save.</li>
          <li>What we don’t collect — no card numbers, no ad tracking, no selling your data.</li>
          <li>Subtitles — we don’t keep them, just process short chunks in real time and store only hashed snippets (can’t be reversed) and words/phrases saved by you.</li>
          <li>Where stored — may be in EU/US servers.</li>
          <li>Your rights — you can request, delete, export your data, or complain to regulators.</li>
          <li>Kids — 18+ only. We don’t collect children’s data.</li>
          <li>Ads — zero ads, zero data sharing with advertisers.</li>
          <li>Account deletion — delete your account → all data gone in 30 days (except legal tax stuff).</li>
        </ul>
        <br />

        <div class="d-flex justify-center">
          <h3>Information We Collect</h3>
        </div>
        <p>We only collect minimal personal information necessary to operate and improve our Services:</p>
        <ul style="margin-left: 30px">
          <li><strong>Email address</strong> — used for account identification and login.</li>
          <li><strong>Password</strong> — used for account authentication and login.</li>
          <li><strong>Apple/Google/Other social provider user ID</strong> — if you choose to log in using Apple/Google or any other social provider.</li>
          <li><strong>Subscription data</strong> — such as plan type and activation date, collected through integrations.</li>
          <li><strong>Learning data</strong> — words and phrases you save for educational purposes.</li>
        </ul>
        <p>
          We store passwords only in a hashed and salted form and never in plain text.
        </p>
        <p>
          We do not collect or store your payment card details.
          All financial transactions are securely processed through the Apple App Store and Google Play Store.
          We receive purchase metadata (such as subscription type, purchase date, renewal status, and transaction identifiers) from Apple and Google via receipts and webhooks.
          This information is strictly limited to non-sensitive purchase metadata and does not include your payment card details.
          We use this data only to verify your subscription, provide access to premium features, and meet legal obligations (such as accounting or tax compliance).
        </p>
        <p>
          We do not store or permanently retain full subtitle texts from streaming platforms.
          In cases where translations are generated, only anonymized, one-way hashes (e.g., MD5)
          of short subtitle segments are stored to enable caching and prevent redundant translation
          requests. These hashes are irreversible and cannot be used to reconstruct the original
          subtitle text.
        </p>
        <p>
          Your data may be stored and processed outside your country of residence, including in the European Union and/or the United States. We ensure that such transfers comply with applicable data protection laws.
        </p>
        <p>
          We may use local storage technologies (such as browser localStorage or app storage) to save your preferences and learning progress.
          We do not use cookies for tracking or advertising purposes.
        </p>
        <p>
          Data Controller: IE Mikhail Chuloshnikov, Armenia, Yerevan, Agatangeghos 7, KENTRON, 0010. D-U-N-S: 933896428
        </p>
        <p>
          Official contact for privacy-related requests: <a :href="'mailto:' + supportEmail">{{supportEmail}}</a>.
        </p>

        <div class="d-flex justify-center">
          <h3>How We Use Your Information</h3>
        </div>
        <p>Your data is used exclusively for:</p>
        <ul style="margin-left: 30px">
          <li>Authenticating your account and enabling sign-in;</li>
          <li>Managing access to subscription-based features;</li>
          <li>Saving and displaying your personal study data;</li>
          <li>Improving the overall functionality and performance of the app;</li>
          <li>Sending optional service-related updates.</li>
        </ul>
        <p>
          We do not share personal data with third parties, except trusted service providers that are necessary to operate our Services (such as cloud hosting providers).
          These providers act only on our instructions and under data protection agreements.
        </p>

        <div class="d-flex justify-center">
          <h3>Data Storage and Security</h3>
        </div>
        <p>
          We apply industry-standard security measures, including encryption in transit (SSL/TLS), hashed and salted passwords, and restricted access to stored data.
        </p>

        <div class="d-flex justify-center">
          <h3>Data Retention</h3>
        </div>
        <p>
          We retain your account data for as long as your account is active.
          If you delete your account, all associated personal data will be removed from our systems within 30 days.
          Purchase-related records may be retained as required by applicable law (e.g., tax or accounting obligations), but are disconnected from user identity after account deletion.
        </p>

        <div class="d-flex justify-center">
          <h3>User Rights</h3>
        </div>
        <p>You have the right to:</p>
        <ul style="margin-left: 30px">
          <li>Access your data;</li>
          <li>Request correction or deletion;</li>
          <li>Withdraw consent to data processing;</li>
          <li>Export your data;</li>
          <li>File a complaint with your local data protection authority (GDPR / CCPA where applicable).</li>
        </ul>
        <p>
          To exercise any of these rights, please contact us at <a :href="'mailto:' + supportEmail">{{supportEmail}}</a>.
          We may ask you to verify your identity before fulfilling your request to ensure security.
          We will respond to your request within 30 days, as required by applicable data protection laws.
        </p>

        <br />
        <div class="d-flex justify-center">
          <h3>No Third-Party Advertising</h3>
        </div>
        <p>
          We do not show ads or share your personal information with advertisers or data brokers.
          We also confirm that we do not "sell" personal data as defined under the California Consumer Privacy Act (CCPA).
        </p>

        <div class="d-flex justify-center">
          <h3>No data sharing</h3>
        </div>
        <p>
          We do not share personal data with third parties, except trusted service providers that are necessary to operate our Services (such as cloud hosting providers). These providers act only on our instructions and under data protection agreements.
        </p>

        <div class="d-flex justify-center">
          <h3>Children</h3>
        </div>
        <p>
          Alunea is not intended for children under the age of 18. We do not knowingly collect personal data from children. If you believe a child has provided us with personal data, please contact us immediately.
        </p>

        <div class="d-flex justify-center">
          <h3>Changes to This Policy</h3>
        </div>
        <p>
          We may occasionally update this Privacy Policy. Continued use of the Services after such changes constitutes your acceptance of the revised policy.
        </p>

        <div class="d-flex justify-center">
          <h3>Contact</h3>
        </div>
        <p>
          For questions or requests related to this Privacy Policy, please contact us at
          <a :href="'mailto:' + supportEmail">{{supportEmail}}</a>.
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
