import {BrowserService} from "./browser-service";

export class InjectionService
{
    constructor(
        protected browserService: BrowserService
    ) {
    }

    public injectScript(src: string, node: Node): Promise<void> {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            if (this.browserService.getBrowserApiPlatform())
            {
                script.src = this.browserService.getBrowserApiPlatform()?.getUrl(src);
            } else {
                script.src = src;
            }

            //script.type = 'module';
            script.onload = () => {
                script.remove();
                resolve();
            };
            script.onerror = (error) => reject(new Error(`Failed to load script: ${src}`));
            node.appendChild(script);
        });
    }

    public injectStyle(src: string, node: Node): void {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        if (this.browserService.getBrowserApiPlatform()) {
            link.href = this.browserService.getBrowserApiPlatform()?.getUrl(src);
        } else {
            link.href = src;
        }

        node.appendChild(link);
    }
}