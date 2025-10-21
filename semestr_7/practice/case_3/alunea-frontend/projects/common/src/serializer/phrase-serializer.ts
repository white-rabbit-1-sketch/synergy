import {Phrase} from "../entity/external/phrase";
import {PhraseDef} from "../definition/alunea-api-definitions";
import {LanguageSerializer} from "./language-serializer";

export class PhraseSerializer {
    constructor(
        protected languageSerializer: LanguageSerializer
    ) {
    }

    public fromJson(phraseData: PhraseDef): Phrase {
        const language = this.languageSerializer.fromJson(phraseData.language);

        const phrase = new Phrase(phraseData.value, language);
        if (phraseData.cefrLevel) {
            phrase.setCefrLevel(phraseData.cefrLevel);
        }
        if (phraseData.transcription) {
            phrase.setTranscription(phraseData.transcription);
        }
        if (phraseData.frequency) {
            phrase.setFrequency(phraseData.frequency);
        }

        return phrase;
    }
}