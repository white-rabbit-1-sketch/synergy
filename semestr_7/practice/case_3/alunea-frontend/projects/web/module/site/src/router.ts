import {createRouter, createWebHistory} from 'vue-router'
import MobileLayout from "@/component/layout/MobileLayout.vue";
import TermsOfUsePage from "@/component/page/TermsOfUsePage.vue";
import PrivacyPolicyPage from "@/component/page/PrivacyPolicyPage.vue";
import IndexPage from "@/component/page/IndexPage.vue";
import AboutUsPage from "@/component/page/AboutUsPage.vue";
import InstructionsPage from "@/component/page/InstructionsPage.vue";
import AccountDeletionPage from "@/component/page/AccountDeletionPage.vue";
import DataDeletionPage from "@/component/page/DataDeletionPage.vue";

const routes: any = {
  routes: [
    {
      path: '/',
      component: MobileLayout,
      children: [
        {
          path: '',
          component: IndexPage,
        },
        {
          path: 'about-us',
          component: AboutUsPage,
        },
        {
          path: 'terms-of-use',
          component: TermsOfUsePage,
        },
        {
          path: 'privacy-policy',
          component: PrivacyPolicyPage,
        },
        {
          path: 'account-deletion',
          component: AccountDeletionPage,
        },
        {
          path: 'data-deletion',
          component: DataDeletionPage,
        },
        {
          path: 'instructions',
          component: InstructionsPage,
        },
      ]
    }
  ],
};
routes.history = createWebHistory();

const router = createRouter({
  history: routes.history,
  routes: routes.routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      const el = document.querySelector(to.hash)
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' })

        return false;
      }
    }

    return { top: 0 }
  },
})

export default router;