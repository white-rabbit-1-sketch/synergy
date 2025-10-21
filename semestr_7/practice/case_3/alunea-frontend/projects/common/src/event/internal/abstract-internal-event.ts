export abstract class AbstractInternalEvent {
    public static getName(): string {
        throw new Error('Method not implemented');
    }

    public abstract getName(): string;
}