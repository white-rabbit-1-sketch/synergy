import {AbstractBrowserMessage} from "../message/browser/abstract-browser-message";
import {BrowserService} from "./browser-service";
import log from "loglevel";

export class BrowserMessageService {
    protected messageRegistry: Map<string, ((message: AbstractBrowserMessage) => void)[]> = new Map();

    constructor(
        protected browserService: BrowserService
    ) {
    }

    public sendToContent(message: AbstractBrowserMessage): void {
        log.debug('✅ Sending browser message to content', message.getName() , message);
        this.browserService.getBrowserApiPlatform()?.sendMessageToTabs({
            name: message.getName(),
            data: message.getData()
        });
    }

    public sendToExtension(message: AbstractBrowserMessage): void {
        log.debug('✅ Sending browser message to extension', message.getName() , message);
        this.browserService.getBrowserApiPlatform()?.sendMessageToRuntime({
            name: message.getName(),
            data: message.getData()
        });
    }

    public async dispatch(message: any): Promise<void> {
        const callbacks = this.messageRegistry.get(message.name);
        log.debug('✅ Dispatching browser message', message.name, message, callbacks);
        if (callbacks) {
            await Promise.all(
                callbacks.map(callback =>
                    Promise.resolve().then(() => callback(message))
                )
            );
        }
    }

    public subscribe(messageName: string, callback: (message: AbstractBrowserMessage) => void): void {
        let callbacks = this.messageRegistry.get(messageName);
        if (!callbacks) {
            callbacks = [];
            this.messageRegistry.set(messageName, callbacks);
        }

        callbacks.push(callback);
    }

    public unsubscribe(messageName: string, callback: (message: AbstractBrowserMessage) => void): void {
        const callbacks = this.messageRegistry.get(messageName);
        if (callbacks) {
            const filteredCallbacks = callbacks.filter(cb => cb !== callback);

            if (filteredCallbacks.length > 0) {
                this.messageRegistry.set(messageName, filteredCallbacks);
            } else {
                this.messageRegistry.delete(messageName);
            }
        }
    }
}