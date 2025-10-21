import {Language} from "../external/language";

export class LanguageVariant {
    protected language: Language | null = null;

    constructor(
        protected code: string,
        protected title: string
    ) {
    }

    public getCode(): string {
        return this.code;
    }

    public setCode(code: string): void {
        this.code = code;
    }

    public getTitle(): string {
        return this.title;
    }

    public setTitle(title: string): void {
        this.title = title;
    }

    public getLanguage(): Language | null {
        return this.language;
    }

    public setLanguage(language: Language | null): void {
        this.language = language;
    }
}