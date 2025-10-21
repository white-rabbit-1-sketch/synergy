import {BrowserApiPlatformInterface} from "browser-api-platform-interface";
import log from "loglevel";

export class ChromeApiPlatform implements BrowserApiPlatformInterface {
    public getPlatformName(): string {
        return 'chrome';
    }

    public isSupported(): boolean {
        return typeof(chrome) !== 'undefined' && !!chrome && (!!chrome.webstore || !!chrome.runtime);
    }

    public hasRuntime(): boolean {
        return typeof(chrome) !== 'undefined' && !!chrome.runtime;
    }

    public getUrl(url: string): string {
        return chrome.runtime.getURL(url);
    }

    public addOnMessageListener(callback: (event: any) => void): void {
        chrome.runtime.onMessage.addListener(callback);
    }

    public addRuntimeOnInstalledListener(callback: (event: any) => void): void {
        chrome.runtime.onInstalled.addListener(callback);
    }

    public addContextMenusOnClickedListener(callback: (info: any, tab: any) => void): void {
        chrome.contextMenus.onClicked.addListener(callback);
    }

    public removeListener(callback: (event) => void): void {
        chrome.runtime.onMessage.removeListener(callback);
    }

    public sendMessageToActiveTab(message: any): void {
        chrome.tabs.query({ active: true, currentWindow: true }, (tabs) => {
            chrome.tabs.sendMessage(tabs[0].id, message);
        });
    }

    public tabsQuery(queryInfo: any, callback: any): void {
        chrome.tabs.query(queryInfo, callback);
    }

    public async removeWindow(windowId: any): Promise<void> {
        if (typeof chrome.windows !== 'undefined' && chrome.windows.remove) {
            await chrome.windows.remove(windowId);
        } else {
            log.warn('chrome.windows.remove is not available in this browser');
        }
    }

    public async createWindow(createData: any, callback: any): Promise<void> {
        if (typeof chrome.windows !== 'undefined' && chrome.windows.create) {
            chrome.windows.create(createData, callback);
        } else if (typeof chrome.tabs !== 'undefined' && chrome.tabs.create) {
            chrome.tabs.create({ url: createData.url }, callback);
        } else {
            throw new Error('No API available to create window or tab');
        }
    }

    public async createTab(createData: any, callback: any): Promise<void> {
        if (typeof chrome.tabs !== 'undefined' && chrome.tabs.create) {
            chrome.tabs.create({ url: createData.url }, callback);
        } else {
            throw new Error('No API available to create window or tab');
        }
    }

    public sendMessageToTabs(message: any): void {
        chrome.tabs.query({}, (tabs) => {
            for (let tab of tabs) {
                if (tab.id) {
                    chrome.tabs.sendMessage(tab.id, message, (response) => {
                        if (chrome.runtime.lastError) {
                            if (
                                !chrome.runtime.lastError.message.includes("Could not establish connection") &&
                                !chrome.runtime.lastError.message.includes("The message port closed before a response was received")
                            ) {
                                throw new Error(chrome.runtime.lastError.message);
                            } else {
                                log.debug(chrome.runtime.lastError.message);
                            }
                        }
                    });

                }
            }
        });
    }

    public sendMessageToRuntime(message: any): void {
        chrome.runtime.sendMessage(message, (response) => {
            if (chrome.runtime.lastError) {
                if (
                    !chrome.runtime.lastError.message.includes("Could not establish connection") &&
                    !chrome.runtime.lastError.message.includes("The message port closed before a response was received")
                ) {
                    throw new Error(chrome.runtime.lastError.message);
                } else {
                    log.debug(chrome.runtime.lastError.message);
                }
            }
        });
    }

    public async set(key: string, value: string): Promise<void> {
        return new Promise((resolve, reject) => {
            chrome.storage.local.set({ [key]: value }, () => {
                if (chrome.runtime.lastError) {
                    reject(chrome.runtime.lastError);
                } else {
                    resolve();
                }
            });
        });
    }

    public async get(key: string): Promise<string | null> {
        return new Promise((resolve, reject) => {
            chrome.storage.local.get([key], (result) => {
                if (chrome.runtime.lastError) {
                    reject(chrome.runtime.lastError);
                } else {
                    resolve(result[key] ?? null);
                }
            });
        });
    }

    public async hasKey(key: string): Promise<boolean> {
        return new Promise((resolve) => {
            chrome.storage.local.get(key, (result) => {
                resolve(result[key] !== undefined);
            });
        });
    }

    public async remove(key: string): Promise<void> {
        return new Promise((resolve, reject) => {
            chrome.storage.local.remove(key, () => {
                if (chrome.runtime.lastError) {
                    reject(chrome.runtime.lastError);
                } else {
                    resolve();
                }
            });
        });
    }

    public launchWebAuthFlow(details: any, callback: (url: string) => {}) {
        if (typeof chrome.identity !== 'undefined' && chrome.identity.launchWebAuthFlow) {
            chrome.identity.launchWebAuthFlow(details, callback);
        } else {
            throw new Error('Safari doesn\'t support launchWebAuthFlow');
        }
    }

    public addTabsOnUpdatedListener(callback): void {
        chrome.tabs.onUpdated.addListener(callback);
    }

    public removeTabsOnUpdatedListener(callback): void {
        chrome.tabs.onUpdated.removeListener(callback);
    }

    public addTabsOnRemovedListener(callback): void {
        chrome.tabs.onRemoved.addListener(callback);
    }

    public removeTabsOnRemovedListener(callback): void {
        chrome.tabs.onRemoved.removeListener(callback);
    }

    public closeCurrentWindow(): void {
        chrome.windows.getCurrent((win) => {
            if (win?.id) {
                this.removeWindow(win.id);
            }
        });
    }

    public contextMenusCreate(id: string, title: string, contexts: string[]): void {
        chrome.contextMenus.create({
            id: id,
            title: title,
            contexts: contexts
        });
    }

    public getExtensionViews(type: string): any[] {
        return chrome.extension.getViews({type: type});
    }
}