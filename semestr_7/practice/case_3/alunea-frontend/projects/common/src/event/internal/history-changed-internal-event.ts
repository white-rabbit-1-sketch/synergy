import {AbstractInternalEvent} from "./abstract-internal-event";

export class HistoryChangedInternalEvent extends AbstractInternalEvent {
    protected static readonly NAME: string = 'alunea.history.changed';

    public static getName(): string {
        return HistoryChangedInternalEvent.NAME;
    }

    public getName(): string {
        return HistoryChangedInternalEvent.NAME;
    }
}