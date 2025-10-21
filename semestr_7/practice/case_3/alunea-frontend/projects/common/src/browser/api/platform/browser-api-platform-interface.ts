export interface BrowserApiPlatformInterface {
    getPlatformName(): string;
    isSupported(): boolean;
    hasRuntime(): boolean;
    getUrl(url: string): string;
    addOnMessageListener(callback: (event) => void);
    addRuntimeOnInstalledListener(callback: (event) => void);
    addContextMenusOnClickedListener(callback: (info, tab) => void);
    removeListener(callback: (event) => void);
    sendMessageToActiveTab(message: any);
    sendMessageToTabs(message: any): void;
    sendMessageToRuntime(message: any);
    get(key: string): Promise<string | null>;
    set(key: string, value: string): Promise<void>;
    remove(key: string): Promise<void>;
    hasKey(key: string): Promise<boolean>;
    launchWebAuthFlow(details: any, callback: (url: string) => {});
    tabsQuery(queryInfo: any, callback: any): void;
    createWindow(createData: any, callback: any): Promise<void>;
    removeWindow(windowId: any): Promise<void>;
    createTab(createData: any, callback: any): Promise<void>;
    addTabsOnUpdatedListener(callback: (tabId, changeInfo, tab) => void);
    removeTabsOnUpdatedListener(callback: (event) => void);
    addTabsOnRemovedListener(callback: (tabId, changeInfo, tab) => void);
    removeTabsOnRemovedListener(callback: (event) => void);
    closeCurrentWindow(): void;
    contextMenusCreate(id: string, title: string, contexts: string[]): void;
    getExtensionViews(type: string): any[];
}