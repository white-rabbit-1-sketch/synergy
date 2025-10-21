export class DeviceService {
    protected static readonly DEVICE_DESKTOP = 'desktop';
    protected static readonly DEVICE_TABLET = 'tablet';
    protected static readonly DEVICE_MOBILE = 'mobile';

    public getDevice(): string {
        let result = DeviceService.DEVICE_DESKTOP;

        if (this.isMobile()) {
            result = DeviceService.DEVICE_MOBILE;
        }

        if (this.isTablet()) {
            result = DeviceService.DEVICE_TABLET;
        }

        return result;
    }

    public isMobile(): boolean {
        const ua = navigator.userAgent || navigator.vendor || (window as any).opera;
        const isMobileUA = /android|iphone|ipod|ipad|windows phone|blackberry|bb10|mobile/i.test(ua);
        const isIPadOS = navigator.userAgent.includes('Macintosh') && 'ontouchend' in document;

        return isMobileUA || isIPadOS;
    }

    public isTablet(): boolean {
        const ua = navigator.userAgent.toLowerCase();

        const isTabletUA = /ipad|tablet|(android(?!.*mobile))/i.test(ua);
        const isIPadOS = navigator.userAgent.includes('Macintosh') && 'ontouchend' in document;

        return isTabletUA || isIPadOS;
    }

    public isFullscreen(): boolean {
        return document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement ||
            document.msFullscreenElement;
    }
}
