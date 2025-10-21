export abstract class AbstractBrowserMessage {
    constructor(
        protected name: string,
        protected data: any = null
    ) {
    }

    public getName(): string {
        return this.name;
    }

    public getData(): any {
        return this.data;
    }
}