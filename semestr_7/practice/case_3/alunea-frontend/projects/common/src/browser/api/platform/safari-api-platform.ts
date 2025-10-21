import { BrowserApiPlatformInterface } from "browser-api-platform-interface";
import log from "loglevel";

declare const browser: typeof chrome;

export class SafariApiPlatform implements BrowserApiPlatformInterface {
    public getPlatformName(): string {
        return 'safari';
    }

    public isSupported(): boolean {
        return typeof browser !== 'undefined' && !!browser.runtime && typeof(browser.runtime.getURL) === 'function';
    }

    public hasRuntime(): boolean {
        return typeof browser !== 'undefined' && !!browser.runtime;
    }

    public getUrl(url: string): string {
        return browser.runtime.getURL(url);
    }

    public addOnMessageListener(callback: (event: any) => void): void {
        browser.runtime.onMessage.addListener(callback);
    }

    public addRuntimeOnInstalledListener(callback: (event: any) => void): void {
        browser.runtime.onInstalled.addListener(callback);
    }

    public addContextMenusOnClickedListener(callback: (info: any, tab: any) => void): void {
        browser.contextMenus.onClicked.addListener(callback);
    }

    public removeListener(callback: (event: any) => void): void {
        browser.runtime.onMessage.removeListener(callback);
    }

    public sendMessageToActiveTab(message: any): void {
        browser.tabs.query({ active: true, currentWindow: true }).then((tabs) => {
            if (tabs[0]?.id) {
                browser.tabs.sendMessage(tabs[0].id, message).catch((err) => {
                    if (
                        !err.message.includes("Could not establish connection") &&
                        !err.message.includes("The message port closed before a response was received")
                    ) {
                        throw new Error(err.message);
                    } else {
                        log.debug(err.message);
                    }
                });
            }
        });
    }

    public tabsQuery(queryInfo: any, callback: any): void {
        browser.tabs.query(queryInfo).then(callback);
    }

    public async removeWindow(windowId: number): Promise<void> {
        if (browser.windows?.remove) {
            await browser.windows.remove(windowId);
        } else {
            log.warn('browser.windows.remove is not available in Safari');
        }
    }

    public async createWindow(createData: any, callback: any): Promise<void> {
        if (browser.windows?.create) {
            const window = await browser.windows.create(createData);
            callback(window);
        } else if (browser.tabs?.create) {
            const tab = await browser.tabs.create({ url: createData.url });
            callback(tab);
        } else {
            throw new Error('No API available to create window or tab');
        }
    }

    public async createTab(createData: any, callback: any): Promise<void> {
        if (browser.tabs?.create) {
            const tab = await browser.tabs.create({ url: createData.url });
            callback(tab);
        } else {
            throw new Error('No API available to create window or tab');
        }
    }

    public sendMessageToTabs(message: any): void {
        browser.tabs.query({}).then((tabs) => {
            for (let tab of tabs) {
                if (tab.id) {
                    browser.tabs.sendMessage(tab.id, message).catch((err) => {
                        if (
                            !err.message.includes("Could not establish connection") &&
                            !err.message.includes("The message port closed before a response was received")
                        ) {
                            throw new Error(err.message);
                        } else {
                            log.debug(err.message);
                        }
                    });
                }
            }
        });
    }

    public sendMessageToRuntime(message: any): void {
        browser.runtime.sendMessage(message).catch((err) => {
            if (
                !err.message.includes("Could not establish connection") &&
                !err.message.includes("The message port closed before a response was received")
            ) {
                throw new Error(err.message);
            } else {
                log.debug(err.message);
            }
        });
    }

    public async set(key: string, value: string): Promise<void> {
        await browser.storage.local.set({ [key]: value });
    }

    public async get(key: string): Promise<string | null> {
        const result = await browser.storage.local.get([key]);
        return result[key] ?? null;
    }

    public async hasKey(key: string): Promise<boolean> {
        const result = await browser.storage.local.get([key]);
        return result[key] !== undefined;
    }

    public async remove(key: string): Promise<void> {
        await browser.storage.local.remove([key]);
    }

    public launchWebAuthFlow(details: any, callback: (url: string) => void): void {
        throw new Error('Safari does not support launchWebAuthFlow');
    }

    public addTabsOnUpdatedListener(callback: (tabId: number, changeInfo: any, tab: any) => void): void {
        browser.tabs.onUpdated.addListener(callback);
    }

    public removeTabsOnUpdatedListener(callback: (tabId: number, changeInfo: any, tab: any) => void): void {
        browser.tabs.onUpdated.removeListener(callback);
    }

    public addTabsOnRemovedListener(callback: (tabId: number, changeInfo: any, tab: any) => void): void {
        browser.tabs.onRemoved.addListener(callback);
    }

    public removeTabsOnRemovedListener(callback: (tabId: number, changeInfo: any, tab: any) => void): void {
        browser.tabs.onRemoved.removeListener(callback);
    }

    public closeCurrentWindow(): void {
        browser.windows.getCurrent((win) => {
            if (win?.id) {
                this.removeWindow(win.id);
            }
        });
    }

    public contextMenusCreate(id: string, title: string, contexts: string[]): void {
        browser.contextMenus.create({
            id: id,
            title: title,
            contexts: contexts
        });
    }

    public getExtensionViews(type: string): any[] {
        return browser.extension.getViews({type: type});
    }
}
