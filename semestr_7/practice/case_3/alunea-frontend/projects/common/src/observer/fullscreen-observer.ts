import log from "loglevel";
import {InternalEventService} from "../service/internal-event-service";
import {FullscreenEnterInternalEvent} from "../event/internal/fullscreen-enter-internal-event";
import {FullscreenLeaveInternalEvent} from "../event/internal/fullscreen-leave-internal-event";
import {AbstractObserver} from "./abstract-observer";

export class FullscreenObserver extends AbstractObserver{
  protected fullscreenObserver: (() => void) | null = null;

  constructor(
      protected internalEventService: InternalEventService
  ) {
    super();
  }

  public start() {
    this.fullscreenObserver = async () => {
      if (document.fullscreenElement) {
        await this.internalEventService.dispatch(new FullscreenEnterInternalEvent());
      } else {
        await this.internalEventService.dispatch(new FullscreenLeaveInternalEvent());
      }
    }

    window.addEventListener('fullscreenchange', this.fullscreenObserver);
    log.debug("✅🟢 FullscreenObserver started");
  }

  public stop() {
    if (this.fullscreenObserver) {
      window.removeEventListener('fullscreenchange', this.fullscreenObserver);
      this.fullscreenObserver = null;
    }

    log.debug('✅🔴 FullscreenObserver stopped');
  }

  public isRun(): boolean {
    return !!this.fullscreenObserver;
  }
}
