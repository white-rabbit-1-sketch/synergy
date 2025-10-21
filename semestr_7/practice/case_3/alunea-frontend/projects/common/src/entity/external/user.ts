import {Language} from "./language";

export class User {
    constructor(
        protected id: string,
        protected email: string,
        protected nativeLanguage: Language,
        protected showSecondarySubtitles: boolean,
        protected highlightRecommendedWords: boolean,
        protected highlightWordsInStudy: boolean,
        protected primarySubtitleSize: string,
        protected secondarySubtitleSize: string,
        protected optIn: boolean,
    ) {
    }

    public getId(): string {
        return this.id;
    }

    public setId(id: string): void {
        this.id = id;
    }

    public getEmail(): string {
        return this.email;
    }

    public setEmail(email: string): void {
        this.email = email;
    }

    public getNativeLanguage(): Language {
        return this.nativeLanguage;
    }

    public setNativeLanguage(nativeLanguage: Language): void {
        this.nativeLanguage = nativeLanguage;
    }

    public getShowSecondarySubtitles(): boolean {
        return this.showSecondarySubtitles;
    }

    public setShowSecondarySubtitles(showSecondarySubtitles: boolean): void {
        this.showSecondarySubtitles = showSecondarySubtitles;
    }

    public getHighlightRecommendedWords(): boolean {
        return this.highlightRecommendedWords;
    }

    public setHighlightRecommendedWords(highlightRecommendedWords: boolean): void {
        this.highlightRecommendedWords = highlightRecommendedWords;
    }

    public getHighlightWordsInStudy(): boolean {
        return this.highlightWordsInStudy;
    }

    public setHighlightWordsInStudy(highlightWordsInStudy: boolean): void {
        this.highlightWordsInStudy = highlightWordsInStudy;
    }

    public getPrimarySubtitleSize(): string {
        return this.primarySubtitleSize;
    }

    public setPrimarySubtitleSize(primarySubtitleSize: string): void {
        this.primarySubtitleSize = primarySubtitleSize;
    }

    public getSecondarySubtitleSize(): string {
        return this.secondarySubtitleSize;
    }

    public setSecondarySubtitleSize(secondarySubtitleSize: string): void {
        this.secondarySubtitleSize = secondarySubtitleSize;
    }

    public getOptIn(): boolean {
        return this.optIn;
    }

    public setOptIN(optIn: boolean): void {
        this.optIn = optIn;
    }
}