import {Language} from "./language";

export class Phrase {
    protected cefrLevel: string | null = null;
    protected transcription: string | null = null;
    protected frequency: number | null = null;

    constructor(
        protected value: string,
        protected language: Language
    ) {
    }

    public getValue(): string {
        return this.value;
    }

    public setValue(value: string): void {
        this.value = value;
    }

    public getLanguage(): Language {
        return this.language;
    }

    public setLanguage(language: Language): void {
        this.language = language;
    }

    public getCefrLevel(): string | null {
        return this.cefrLevel;
    }

    public setCefrLevel(cefrLevel: string | null): void {
        this.cefrLevel = cefrLevel;
    }

    public getTranscription(): string | null {
        return this.transcription;
    }

    public setTranscription(transcription: string | null): void {
        this.transcription = transcription;
    }

    public getFrequency(): number | null {
        return this.frequency;
    }

    public setFrequency(frequency: number | null): void {
        this.frequency = frequency;
    }
}