import {AbstractInternalEvent} from "./abstract-internal-event";

export class FullscreenLeaveInternalEvent extends AbstractInternalEvent {
    protected static readonly NAME: string = 'alunea.fullscreen.leave';

    public static getName(): string {
        return FullscreenLeaveInternalEvent.NAME;
    }

    public getName(): string {
        return FullscreenLeaveInternalEvent.NAME;
    }
}