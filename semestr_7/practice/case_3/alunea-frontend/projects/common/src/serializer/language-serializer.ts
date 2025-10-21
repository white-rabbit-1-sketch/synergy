import {LanguageDef} from "../definition/alunea-api-definitions";
import {Language} from "../entity/external/language";

export class LanguageSerializer {
    public fromJson(languageData: LanguageDef): Language {
        return new Language(languageData.code, languageData.title);
    }
}