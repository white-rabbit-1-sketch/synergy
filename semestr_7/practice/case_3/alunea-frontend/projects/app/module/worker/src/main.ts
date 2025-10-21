import {container} from "@/container";
import log from "../../../../common/src/log";
import {ContextService} from "../../../../common/src/service/context-service";
import {BrowserService} from "../../../../common/src/service/browser-service";

log.setLevel(import.meta.env.VITE_LOG_LEVEL);

const contextService = container.get(ContextService);
contextService.setContext(ContextService.CONTEXT_WORKER);

const browseService = container.get(BrowserService);
const browserApiPlatform = browseService.getBrowserApiPlatform();

browserApiPlatform?.addRuntimeOnInstalledListener(() => {
    browserApiPlatform?.contextMenusCreate(
        'open-in-tab',
        '✨Open in tab',
        ['action']
    );
});



browserApiPlatform?.addContextMenusOnClickedListener((info, tab) => {
    if (info.menuItemId === 'open-in-tab') {
        browserApiPlatform?.createTab({
            url: 'core/index.html'
        }, () => {});
    }
});
