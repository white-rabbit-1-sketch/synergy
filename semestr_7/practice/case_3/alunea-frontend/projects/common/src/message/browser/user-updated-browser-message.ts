import {AbstractBrowserMessage} from "./abstract-browser-message";

export class UserUpdatedBrowserMessage extends AbstractBrowserMessage {
    public static readonly NAME = 'alunea.message.user.updated';

    constructor() {
        super(UserUpdatedBrowserMessage.NAME);
    }

    public static getName(): string {
        return UserUpdatedBrowserMessage.NAME;
    }
}