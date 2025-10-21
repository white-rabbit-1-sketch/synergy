export class ContextService {
    public static readonly CONTEXT_PAGE = 'Page';
    public static readonly CONTEXT_CORE = 'Core';
    public static readonly CONTEXT_CONTENT = 'Content';
    public static readonly CONTEXT_WORKER = 'Worker';
    public static readonly CONTEXT_SITE = 'Site';

    protected context: string | null = null;

    public isCore (): boolean {
        return this.context == ContextService.CONTEXT_CORE;
    }

    public isContent(): boolean {
        return this.context == ContextService.CONTEXT_CONTENT;
    }

    public isPage(): boolean {
        return this.context == ContextService.CONTEXT_PAGE;
    }

    public getContext(): string | null {
        return this.context;
    }

    public setContext(context: string | null): void {
        this.context = context;
    }
}
