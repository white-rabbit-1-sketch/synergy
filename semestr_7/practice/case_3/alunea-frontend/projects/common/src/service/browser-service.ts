import {BrowserApiPlatformInterface} from "../browser/api/platform/browser-api-platform-interface";
import {ChromeApiPlatform} from "../browser/api/platform/chrome-api-platform";
import {DeviceService} from "./device-service";
import {SafariApiPlatform} from "../browser/api/platform/safari-api-platform";
import {PlatformService} from "./platform-service";
import {Browser} from "@capacitor/browser";
import {DefaultSystemBrowserOptions, InAppBrowser} from '@capacitor/inappbrowser';

export class BrowserService {
    public static readonly BROWSER_BRAVE = 'brave';
    public static readonly BROWSER_BRAVE_MOBILE = 'brave-mobile';
    public static readonly BROWSER_ORION = 'orion';
    public static readonly BROWSER_ORION_MOBILE = 'orion-mobile';
    public static readonly BROWSER_EDGE = 'edge';
    public static readonly BROWSER_EDGE_MOBILE = 'edge-mobile';
    public static readonly BROWSER_OPERA = 'opera';
    public static readonly BROWSER_OPERA_MOBILE = 'opera-mobile';
    public static readonly BROWSER_FIREFOX = 'firefox';
    public static readonly BROWSER_FIREFOX_MOBILE = 'firefox-mobile';
    public static readonly BROWSER_CHROME = 'chrome';
    public static readonly BROWSER_CHROME_MOBILE = 'chrome-mobile';
    public static readonly BROWSER_SAFARI = 'safari';
    public static readonly BROWSER_SAFARI_MOBILE = 'safari-mobile';

    constructor(
        protected chromeApiPlatformApi: ChromeApiPlatform,
        protected safariApiPlatformApi: SafariApiPlatform,
        protected deviceService: DeviceService,
        protected platformService: PlatformService,
    ) {
    }

    public getBrowserApiPlatform(): BrowserApiPlatformInterface | null {
        let result = null;

        if (this.chromeApiPlatformApi.isSupported()) {
            result = this.chromeApiPlatformApi;
        } else if (this.safariApiPlatformApi.isSupported()) {
            result = this.safariApiPlatformApi;
        }

        return result;
    }

    public getBrowserName(): string | null {
        const ua = navigator.userAgent.toLowerCase();
        const vendor = navigator.vendor;

        const isMobile = this.deviceService.isMobile();
        const isChrome = (ua.includes('chrome') && vendor === 'Google Inc.') ||
            ua.includes('crios');
        const isBrave = (navigator as any).brave && typeof (navigator as any).brave.isBrave === 'function';
        const isOrion =
            ((window as any).OrionInternals && typeof (window as any).OrionInternals === 'object') ||
            ((window as any).KAGI && typeof (window as any).KAGI === 'object')
        ;
        const isOpera = ua.includes('opr') || ua.includes('opera') || ua.includes('opt');
        const isEdge = ua.includes('edg');
        const isSafari =
            ua.includes('safari') && vendor === 'Apple Computer, Inc.' &&
            !isOrion &&
            !isChrome &&
            !isOpera &&
            !isEdge;

        const isFirefox = ua.includes('firefox') || ua.includes('fxios');

        switch (true) {
            case isBrave:
                return isMobile ? BrowserService.BROWSER_BRAVE_MOBILE : BrowserService.BROWSER_BRAVE;
            case isEdge:
                return isMobile ? BrowserService.BROWSER_EDGE_MOBILE : BrowserService.BROWSER_EDGE;
            case isOpera:
                return isMobile ? BrowserService.BROWSER_OPERA_MOBILE : BrowserService.BROWSER_OPERA;
            case isFirefox:
                return isMobile ? BrowserService.BROWSER_FIREFOX_MOBILE : BrowserService.BROWSER_FIREFOX;
            case isOrion:
                return isMobile ? BrowserService.BROWSER_ORION_MOBILE : BrowserService.BROWSER_ORION;
            case isSafari:
                return isMobile ? BrowserService.BROWSER_SAFARI_MOBILE : BrowserService.BROWSER_SAFARI;
            case isChrome:
                return isMobile ? BrowserService.BROWSER_CHROME_MOBILE : BrowserService.BROWSER_CHROME;
            default:
                return null;
        }
    }

    public isSafariDesktop(): boolean {
        return this.getBrowserName() === BrowserService.BROWSER_SAFARI;
    }

    public isSafariMobile(): boolean {
        return this.getBrowserName() === BrowserService.BROWSER_SAFARI_MOBILE;
    }

    public isOrionDesktop(): boolean {
        return this.getBrowserName() === BrowserService.BROWSER_ORION;
    }

    public isOrionMobile(): boolean {
        return this.getBrowserName() === BrowserService.BROWSER_ORION_MOBILE;
    }

    public isEdgeDesktop(): boolean {
        return this.getBrowserName() === BrowserService.BROWSER_EDGE;
    }

    public isEdgeMobile(): boolean {
        return this.getBrowserName() === BrowserService.BROWSER_EDGE_MOBILE;
    }

    public async onBrowserClose(callback: (() => void)): Promise<void> {
        if (this.platformService.isIos()) {
            await Browser.addListener('browserFinished', callback);
        } else if (this.platformService.isAndroid()) {
            await InAppBrowser.addListener('browserClosed', callback);
        } else {
            throw new Error('Only native platform supported');
        }
    }

    public async removeAllListeners(): Promise<void> {
        if (this.platformService.isIos()) {
            await Browser.removeAllListeners();
        } else if (this.platformService.isAndroid()) {
            InAppBrowser.removeAllListeners();
        } else {
            throw new Error('Only native platform supported');
        }
    }

    public async close(): Promise<void> {
        if (this.platformService.isIos()) {
            await Browser.close();
        } else if (this.platformService.isAndroid()) {
            await InAppBrowser.close();
        } else {
            throw new Error('Only native platform supported');
        }
    }

    public async openPopover(url, title) {
        if (this.platformService.isIos()) {
            await Browser.open({
                url: url,
                presentationStyle: 'popover',
                windowName: title
            });
        } else if (this.platformService.isAndroid()) {
            await InAppBrowser.openInSystemBrowser({
                url: url,
                options: DefaultSystemBrowserOptions
            });
        } else if (this.getBrowserApiPlatform()) {
            this.getBrowserApiPlatform()?.createTab({
                url: url,
            }, function (newTab) {
            });
        } else {
            if (this.isSafariDesktop()) {
                window.open(url, '_blank');
            } else {
                window.open(url, title);
            }
        }
    }

    public openFullscreen(url, title) {
        if (this.platformService.isNative()) {
            Browser.open({
                url: url,
                presentationStyle: 'fullscreen',
            });
        } else if(this.getBrowserApiPlatform()) {
            this.getBrowserApiPlatform()?.createTab({
                url: url,
            }, function(newTab) {});
        } else {
            window.open(url, title);
        }
    }

    public isPopup(): boolean {
        let result = false;

        const browserApiPlatform = this.getBrowserApiPlatform();
        if (browserApiPlatform) {
            let popups = browserApiPlatform.getExtensionViews("popup");
            if (popups.includes(window)) {
                result = true;
            }
        }

        return result;
    }

    public isExtension(): boolean {
        let result = false;

        const browserApiPlatform = this.getBrowserApiPlatform();
        if (browserApiPlatform) {
            result = true;
        }

        return result;
    }
}