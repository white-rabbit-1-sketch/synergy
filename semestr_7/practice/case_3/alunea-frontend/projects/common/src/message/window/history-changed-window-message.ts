import {AbstractPageMessage} from "./page/abstract-page-message";

export class HistoryChangedWindowMessage extends AbstractPageMessage {
    public static readonly NAME = 'alunea.window-message.history.changed';

    public getName(): string {
        return HistoryChangedWindowMessage.NAME;
    }
}