import '../assets/style/global.css';
import {container} from "@/container";
import log from "../../../../common/src/log";
import {InternalEventService} from "../../../../common/src/service/internal-event-service";
import {HistoryChangedInternalEvent} from "../../../../common/src/event/internal/history-changed-internal-event";
import {ErrorHandler} from "../../../../common/src/handler/error-handler";
import {WindowMessageObserver} from "../../../../common/src/observer/window-message-observer";
import {HistoryObserver} from "../../../../common/src/observer/history-observer";
import {ContextService} from "../../../../common/src/service/context-service";
import {
    HistoryChangedWindowMessageBridge
} from "../../../../common/src/observer/bridge/message/window/history-changed-window-message-bridge";
import {WatcherService} from "../../../../common/src/service/watcher-service";

log.setLevel(import.meta.env.VITE_LOG_LEVEL);
const errorHandler = container.get(ErrorHandler);
errorHandler.init();
const contextService = container.get(ContextService);
contextService.setContext(ContextService.CONTEXT_PAGE);

const historyObserver = container.get(HistoryObserver);
const historyChangedWindowMessageBridge = container.get(HistoryChangedWindowMessageBridge);
const windowMessageObserver = container.get(WindowMessageObserver);
const internalEventService = container.get(InternalEventService);
const watcherService = container.get(WatcherService);

historyObserver.start();
historyChangedWindowMessageBridge.start();
windowMessageObserver.start();

watcherService.getSupportedWatcher()?.startPageWatch();
internalEventService.subscribe(HistoryChangedInternalEvent.getName(), () => {
    watcherService.stopWatchersPageWatch();
    watcherService.getSupportedWatcher()?.startPageWatch();
});