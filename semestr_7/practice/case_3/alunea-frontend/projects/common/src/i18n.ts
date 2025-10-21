import { createI18n } from 'vue-i18n';

const messages = Object.fromEntries(
    Object.entries(import.meta.glob('./locale/*.json', { eager: true }))
        .map(([path, mod]) => {
            const code = path.match(/\.\/locale\/(.*?)\.json$/)?.[1];
            return [code, mod.default];
        })
);

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages,
});

export default i18n;
