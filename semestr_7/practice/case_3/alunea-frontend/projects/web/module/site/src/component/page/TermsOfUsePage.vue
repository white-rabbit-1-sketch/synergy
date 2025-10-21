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
          <h2>Terms of Use</h2>
        </div>
        <div class="d-flex justify-center">
          <h3>Introduction</h3>
        </div>

        <p>
          This Terms of Use applies to the Alunea browser extension, mobile app, and related services ("Services").
          By accessing or using Alunea (browser extension, mobile app, or related services), you automatically agree to these Terms of Use and our Privacy Policy.
          If you do not agree, please stop using Alunea immediately.
        </p>

        <div class="d-flex justify-center">
          <h3>TL;DR (Straightforward Version)</h3>
        </div>
        <br />
        <ul style="margin-left: 30px">
          <li>Who can use — adults only (18+).</li>
          <li>Purpose — for learning only, not for business or piracy.</li>
          <li>Subtitles — we don’t keep them, just process short chunks in real time and store only hashed snippets (can’t be reversed) and words/phrases saved by you.</li>
          <li>No DRM hacks — we don’t crack or bypass protections.</li>
          <li>Streaming platforms — not affiliated with Netflix, YouTube, Disney, etc. We just overlay translations and some learning functions.</li>
          <li>Payments — we never see your card. Everything goes through App Store / Google Play.</li>
          <li>Misuse — break the rules, we can suspend your account.</li>
          <li>Updates — sometimes stuff may break when platforms change, we’ll try to fix it.</li>
          <li>Liability — you use it “as is.” We’re not responsible for any third-party outage.</li>
          <li>Law — Armenian law applies, courts in Yerevan handle disputes.</li>
        </ul>

        <br />

        <div class="d-flex justify-center">
          <h3>Eligibility</h3>
        </div>
        <p>
          You must be at least 18 years old to use our Services. By using Alunea, you represent that you meet this requirement and are legally permitted to enter into these Terms.
        </p>

        <div class="d-flex justify-center">
          <h3>Purpose and Usage</h3>
        </div>
        <p>
          Alunea is designed for personal, non-commercial, educational purposes only. The Services enhance subtitle-based viewing experiences by allowing dual subtitles, enriched word data, and vocabulary tools to support language learning.
        </p>
        <p>
          We are not affiliated with, endorsed by, or officially connected to any third-party streaming services. All trademarks and content belong to their respective owners.
        </p>

        <div class="d-flex justify-center">
          <h3>Subtitle Processing and Data Usage</h3>
        </div>
        <p>
          To provide core features such as dual-language subtitle display, contextual translations, and vocabulary enrichment, Alunea processes subtitle data during video playback. This processing happens in real-time and is designed with <strong>user privacy</strong> and <strong>copyright compliance</strong> in mind.
        </p>
        <p>
          <strong>No storage of original subtitle content</strong><br/>
          We do not store or permanently retain full subtitle texts from streaming platforms. In cases where translations are generated, only anonymized, one-way hashes (e.g., MD5) of short subtitle segments are stored to enable caching and prevent redundant translation requests. These hashes are irreversible and cannot be used to reconstruct the original subtitle text.
        </p>
        <p>
          <strong>Real-time, contextual processing only</strong><br/>
          Alunea never processes entire subtitle tracks in bulk. Instead, it dynamically processes only the few upcoming subtitle lines (e.g., 10 at a time) required for immediate playback and user experience. This behavior ensures minimal interaction with streaming content and reflects our respect for the technical and legal boundaries of the platforms.
        </p>
        <p>
          <strong>Vocabulary enrichment</strong><br/>
          To enable word-level enrichment (e.g., definitions, examples, pronunciation), the Alunea extension temporarily analyzes subtitle fragments and extracts individual words. These words may be stored to improve response time and reduce computational load. Since individual words are not subject to copyright protection, this use does not constitute reproduction of copyrighted material.
        </p>
        <p>
          <strong>Lexical units and tokenization</strong><br/>
          Alunea may analyze subtitle fragments and extract lexical units — sequences of one or more words that form meaningful expressions (such as phrasal verbs, idioms, or collocations).
          Individual words and lexical units are part of natural language and are not protected by copyright.
          The length of such units may vary depending on linguistic structure.
          Their storage and analysis serve solely educational and linguistic purposes within fair use principles, and no complete sentences or expressive dialogue are retained.
        </p>
        <p>
          <strong>User-saved entries</strong><br/>
          Users may optionally save specific words or phrases to their personal study list. These entries, including surrounding context (e.g., timestamp, video title, platform), are stored solely to support language learning features. Such saved content represents isolated, minimal portions of the original work and is used strictly for educational purposes under fair use principles. Alunea does not provide tools to export, share, or publish this data in a way that would substitute or reproduce copyrighted works.
        </p>
        <p>
          <strong>
            We are committed to ensuring that all data processing complies with applicable intellectual property laws and is limited to what is necessary for functionality and educational use.
          </strong>
        </p>

        <div class="d-flex justify-center">
          <h3>Respect for DRM</h3>
        </div>
        <p>
          Alunea does not circumvent, alter, or bypass any digital rights management (DRM) technologies, content protection mechanisms, or access restrictions used by streaming platforms.
        </p>
        <p>
          <strong>Subtitle Access</strong><br/>
          Alunea processes only subtitle files that are openly accessible during normal playback in the user’s browser session. Subtitle requests are observed and retrieved exactly as delivered by the streaming platform, without altering, decrypting, or bypassing any encryption, access controls, or DRM technologies. This method is equivalent to viewing or downloading subtitles via the browser’s developer tools and does not involve any circumvention of protected video or audio streams.
        </p>
        <p>
          <strong>Subtitle retrieval via player APIs</strong><br/>
          When dual subtitles are enabled, Alunea may temporarily instruct the video player to switch subtitle tracks in order to request the required language version.
          This process uses only publicly accessible JavaScript interfaces of the streaming platform and does not modify, decrypt, or bypass any protected systems.
          The subtitle track is immediately restored to its original state after retrieval.
        </p>

        <div class="d-flex justify-center">
          <h3>Page Reload Behavior</h3>
        </div>
        <p>
          To ensure proper initialization and compatibility with streaming platforms, Alunea may trigger a standard browser page reload when a new video session starts.
          This uses normal browser functionality and does not alter or interfere with the platform’s DRM, media streams, or playback systems.
        </p>

        <div class="d-flex justify-center">
          <h3>Interface Behavior and Respect for Streaming Platforms</h3>
        </div>
        <p>
          Alunea is designed to be as non-intrusive as possible in its interaction with third-party streaming platforms. The extension overlays dual-language subtitles in a lightweight and reversible manner, without interfering with playback controls, branding, content layout, or other elements of the streaming user interface.
        </p>
        <p>
          Whenever official subtitles in the user’s preferred language are available on the streaming platform, Alunea uses them directly, enabling a side-by-side native subtitle experience. Only in cases where a translation is not provided by the platform, Alunea may generate a machine translation for educational purposes.
        </p>
        <p>
          This design ensures that:
        </p>
        <ul style="margin-left: 30px">
          <li>Alunea does not alter, damage, or obscure the core experience intended by the streaming platform.</li>
          <li>The Service does not act as a replacement for platform functionality or content.</li>
          <li>There is no intention to undermine the commercial value or subscription model of any streaming provider.</li>
          <li>Our goal is to enhance the language learning process while fully respecting the visual, functional, and legal integrity of the streaming services our users choose to engage with.</li>
        </ul>

        <br />

        <div class="d-flex justify-center">
          <h3>User Content</h3>
        </div>
        <p>
          Any words or phrases you save are processed only for your personal learning purposes.
          You retain ownership of your saved content and can request its deletion at any time by contacting us.
        </p>

        <div class="d-flex justify-center">
          <h3>Restrictions</h3>
        </div>
        <p>You agree not to use the Services to:</p>

        <ul style="margin-left: 30px">
          <li>Violate any applicable laws or regulations;</li>
          <li>Infringe upon the intellectual property rights of others;</li>
          <li>Reverse-engineer, decompile, or tamper with the Services;</li>
          <li>Use the Services for any commercial purposes or resale.</li>
        </ul>

        <br />

        <div class="d-flex justify-center">
          <h3>Abuse and Misuse of Services</h3>
        </div>
        <p>
          Any form of abuse, exploitation, or misuse of the Services — including but not limited to taking advantage of bugs, unfinished features, loopholes, technical glitches, or other unintended behaviors — is strictly prohibited.
        </p>
        <p>
          We reserve the right, at our sole discretion, to suspend or permanently terminate your account without prior notice if such abusive behavior is detected. No refunds will be provided in case of account suspension or termination due to abuse.
        </p>

        <div class="d-flex justify-center">
          <h3>Fair Use of Premium Features</h3>
        </div>
        <p>
          A premium subscription removes standard limits on features such as adding words/phrases, generating translations and others. However, this does not grant unlimited or uncontrolled use of system resources.
        </p>
        <p>
          If we detect unusual activity patterns — for example, excessive or automated requests far exceeding normal user behavior — we reserve the right to temporarily restrict, throttle, or suspend such activity. This is to protect the stability of the Services and prevent abuse.
        </p>
        <p>Unusual activity may include, but is not limited to:</p>
        <ul style="margin-left: 30px">
          <li>Request volumes significantly higher than typical user averages;</li>
          <li>Automated or scripted use of the Services;</li>
          <li>Any behavior that threatens service availability for other users.</li>
        </ul>
        <br />
        <p>Such cases will be treated as abuse under these Terms and may result in account suspension or termination without refund.</p>

        <div class="d-flex justify-center">
          <h3>Privacy</h3>
        </div>
        <p>
          We do not collect personally identifiable information without your consent. For more details about how we handle data, please refer to our Privacy Policy.
        </p>

        <div class="d-flex justify-center">
          <h3>Third-Party Services</h3>
        </div>
        <p>
          Alunea interacts with external services like streaming-platforms to function, but we do not control or take responsibility for third-party content, availability, or behavior.
        </p>

        <div class="d-flex justify-center">
          <h3>Third-Party Dependencies and Availability</h3>
        </div>
        <p>
          Some features of Alunea depend on third-party streaming platforms. These platforms may update or change their systems without notice, and such changes may temporarily affect compatibility.
        </p>
        <p>
          We provide best-effort support to maintain functionality, but we do not guarantee continuous operation with any specific platform or feature.
        </p>
        <p>
          Subscriptions grant access to Alunea’s learning tools (dual subtitles, translations, vocabulary, etc.) as a whole and are not tied to the uninterrupted availability of any single third-party integration.
        </p>

        <div class="d-flex justify-center">
          <h3>No Affiliation with Streaming Platforms</h3>
        </div>
        <p>
          Alunea is an independent product and is not affiliated with, endorsed by, or sponsored by Netflix, YouTube, Amazon Prime Video, Disney+, or any other streaming service.
          All trademarks, logos, and service marks mentioned are the property of their respective owners and are used solely for identification and descriptive purposes.
        </p>

        <div class="d-flex justify-center">
          <h3>Subscriptions</h3>
        </div>
        <p>
          We do not collect or store your payment card details.
          All financial transactions are securely processed through the Apple App Store and Google Play Store.
          By purchasing a subscription through the Apple App Store or Google Play Store, you authorize us to receive and process purchase-related metadata (such as subscription type, purchase date, renewal status, and transaction identifiers) from Apple and Google via receipts and webhooks.
          This information is strictly limited to non-sensitive purchase metadata and does not include your payment card details.
          We use this data only to verify your subscription, provide access to premium features, and meet legal obligations (such as accounting or tax compliance).
        </p>

        <div class="d-flex justify-center">
          <h3>Termination</h3>
        </div>
        <p>
          We reserve the right to suspend or terminate your access to the Services at any time and without notice, especially in the case of violation of these Terms.
        </p>

        <div class="d-flex justify-center">
          <h3>Modification or Discontinuation of Services</h3>
        </div>
        <p>
          We reserve the right to modify, suspend, or discontinue any part of the Services at any time, temporarily or permanently, without liability to you. While we aim to provide continuity, we cannot guarantee the uninterrupted availability of any specific feature or integration.
        </p>

        <div class="d-flex justify-center">
          <h3>Disclaimer of Warranties</h3>
        </div>
        <p>
          The Services are provided "as is" and "as available" without warranties of any kind. We do not guarantee uninterrupted operation, accurate translations, or compatibility with all streaming platforms.
          <strong>Compatibility with third-party platforms may change at any time due to factors outside our control.</strong>
        </p>

        <div class="d-flex justify-center">
          <h3>Translation Quality Disclaimer</h3>
        </div>
        <p>
          While we strive to provide accurate, natural, and contextually relevant translations,
          <strong>Alunea does not guarantee the quality, accuracy, or reliability of any translation results</strong>.
          Translation output may vary depending on language pairs, sentence complexity, idiomatic expressions,
          machine translation models, or other technical and linguistic factors beyond our control.
        </p>
        <p>
          We continuously improve our translation algorithms and data sources to enhance user experience,
          but <strong>all translations are provided on a best-effort basis and “as is.”</strong>
          You acknowledge that automated translations may contain inaccuracies or unintended meanings
          and should not be relied upon for professional, legal, medical, or other sensitive contexts.
        </p>
        <p>
          The goal of Alunea is to support language learning, not to provide certified or authoritative translations.
          By using our Services, you accept that translation quality may differ across languages, genres, and content types.
        </p>

        <div class="d-flex justify-center">
          <h3>Force Majeure</h3>
        </div>
        <p>
          We are not liable for any delays or failures in performance caused by events beyond our reasonable control, including but not limited to natural disasters, war, government actions, internet or telecommunications failures, hosting provider outages, or changes made by third-party streaming platforms.
        </p>

        <div class="d-flex justify-center">
          <h3>Limitation of Liability</h3>
        </div>
        <p>
          To the maximum extent permitted by law, Alunea and its developers shall not be liable for any indirect, incidental, or consequential damages arising out of your use of the Services.
          In no event shall our liability exceed the amount paid by you (if any) for using the Services during the last 12 months.
        </p>

        <div class="d-flex justify-center">
          <h3>Governing Law and Jurisdiction</h3>
        </div>
        <p>
          These Terms are governed by and construed in accordance with the laws of the Republic of Armenia, regardless of your country of residence or the location from which you access the Services. Any disputes arising from or relating to these Terms shall be subject to the exclusive jurisdiction of the courts of Yerevan, Armenia.
        </p>

        <div class="d-flex justify-center">
          <h3>Severability</h3>
        </div>
        <p>
          If any provision of these Terms is found to be invalid or unenforceable, the remaining provisions shall remain in full force and effect.
        </p>

        <div class="d-flex justify-center">
          <h3>Waiver</h3>
        </div>
        <p>
          Our failure to enforce any provision of these Terms shall not constitute a waiver of our right to enforce that provision or any other provision in the future.
        </p>

        <div class="d-flex justify-center">
          <h3>Survival</h3>
        </div>
        <p>
          The provisions of these Terms relating to intellectual property, disclaimers, limitations of liability, governing law, and other provisions which by their nature should survive termination, shall remain in effect even after your account is terminated or you stop using the Services.
        </p>

        <div class="d-flex justify-center">
          <h3>Headings</h3>
        </div>
        <p>
          The section titles and headings in these Terms are for convenience only and shall not affect the interpretation of the provisions herein.
        </p>

        <div class="d-flex justify-center">
          <h3>Entire Agreement</h3>
        </div>
        <p>
          These Terms constitute the entire agreement between you and Alunea regarding the Services and supersede all prior agreements, communications, and understandings.
        </p>

        <div class="d-flex justify-center">
          <h3>Changes to Terms</h3>
        </div>
        <p>
          We may update these Terms at any time. Continued use of the Services after such changes constitutes your acceptance of the updated Terms.
        </p>

        <div class="d-flex justify-center">
          <h3>Legal Entity and Data Controller</h3>
        </div>
        <p>
          The Services are provided by IE Mikhail Chuloshnikov, located in Yerevan, Armenia (Agatangeghos 7, Kentron, 0010). For the purposes of applicable data protection laws (including GDPR and CCPA where applicable), IE Mikhail Chuloshnikov acts as the data controller of your personal information.
        </p>

        <div class="d-flex justify-center">
          <h3>Compliance Summary</h3>
        </div>
        <p>
          Alunea operates strictly within the boundaries of applicable copyright and data protection laws.
          The extension processes only subtitle data already delivered to the user's browser, uses public player interfaces, and never circumvents DRM or protected content.
          All processing serves legitimate educational purposes, with minimal and anonymized data handling.
          All automated actions performed by Alunea replicate legitimate user interactions available in the streaming platform’s standard interface.
        </p>

        <div class="d-flex justify-center">
          <h3>Contact</h3>
        </div>
        <p>
          If you have any questions about these Terms, please contact us at <a :href="'mailto:' + supportEmail">{{supportEmail}}</a>.
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