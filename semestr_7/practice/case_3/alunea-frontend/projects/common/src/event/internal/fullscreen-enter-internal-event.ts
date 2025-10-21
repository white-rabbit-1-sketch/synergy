import {AbstractInternalEvent} from "./abstract-internal-event";

export class FullscreenEnterInternalEvent extends AbstractInternalEvent {
    protected static readonly NAME: string = 'alunea.fullscreen.enter';

    public static getName(): string {
        return FullscreenEnterInternalEvent.NAME;
    }

    public getName(): string {
        return FullscreenEnterInternalEvent.NAME;
    }
}