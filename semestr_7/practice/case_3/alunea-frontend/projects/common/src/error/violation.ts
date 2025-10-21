export class Violation extends Error {
    constructor(
        message?: string,
        protected reasonCode: string | null = null
    ) {
        super(message);

        this.name = 'Violation';
        Object.setPrototypeOf(this, new.target.prototype);
    }

    public getReasonCode(): string | null {
        return this.reasonCode;
    }
}