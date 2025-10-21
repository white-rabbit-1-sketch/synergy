import {AxiosService} from "../service/axios-service";
import {ExtensionVideoPhraseOverviewSerializer} from "../serializer/overview/extension-video-phrase-overview-serializer";
import {ExtensionVideoPhraseOverview} from "../entity/external/overview/extension-video-phrase-overview";
import {AppPhraseOverview} from "../entity/external/overview/app-phrase-overview";
import {AppPhraseOverviewSerializer} from "../serializer/overview/app-phrase-overview-serializer";
import {TranslationDef} from "../definition/alunea-api-definitions";

export class PhraseClient
{
    constructor(
        protected clientService: AxiosService,
        protected extensionVideoPhraseOverviewSerializer: ExtensionVideoPhraseOverviewSerializer,
        protected appPhraseOverviewSerializer: AppPhraseOverviewSerializer,
    ) {
    }

    public async markPhraseAsInStudy(
        userId: string,
        sourceLanguageCode: string,
        phrase: string,
        contextIntegration: string,
        contextVideoId: string | null,
        contextVideoName: string | null,
        contextEpisodeName: string | null,
        contextEpisodeNumber: number | null,
        contextVideoTime: number | null,
    ): Promise<boolean> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/phrase/mark-as-in-study`,
            {
                sourceLanguageCode: sourceLanguageCode,
                phrase: phrase,
                contextIntegration: contextIntegration,
                ...(contextVideoId && { contextVideoId }),
                ...(contextVideoName && { contextVideoName }),
                ...(contextEpisodeName && { contextEpisodeName }),
                ...(contextEpisodeNumber && { contextEpisodeNumber }),
                ...(contextVideoTime && { contextVideoTime }),
            }
        );

        return response.status == 204;
    }

    public async markPhraseAsStudied(
        userId: string,
        sourceLanguageCode: string,
        phrase: string
    ): Promise<boolean> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/phrase/mark-as-studied`,
            {
                sourceLanguageCode: sourceLanguageCode,
                phrase: phrase
            }
        );

        return response.status == 204;
    }

    public async translatePhrases(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        phrases: string[]
    ): Promise<string[]> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/phrases/translate`,
            {
                sourceLanguageCode: sourceLanguageCode,
                targetLanguageCode: targetLanguageCode,
                phrases: phrases,
            }
        );

        return response.status == 200 ? response.data.translations : [];
    }

    public async getExtensionVideoPhraseOverviewsByValues(
        userId: string,
        sourceLanguageCode: string,
        phrases: string[]
    ): Promise<ExtensionVideoPhraseOverview[]> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/phrases/extension-video-overviews/by-values`,
            {
                sourceLanguageCode: sourceLanguageCode,
                phrases: phrases
            }
        );

        return response.status == 200 ? this.extensionVideoPhraseOverviewSerializer.fromJsonArray(response.data.extensionVideoPhraseOverviews) : [];
    }

    public async getAppPhraseOverviews(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        userPhraseReferenceStatus: string,
        limit: number,
        offset: number,
        sort: string | null = null,
        query: string | null = null,
        signal = null,
    ): Promise<AppPhraseOverview[]> {
        const response = await this.clientService.getApiClientInstance().get(
            `/v1/user/${userId}/phrases/app-overviews`,
            {
                params: {
                    sourceLanguageCode,
                    targetLanguageCode,
                    userPhraseReferenceStatus,
                    limit,
                    offset,
                    sort,
                    query
                },
                signal
            }
        );

        return response.status == 200
            ? this.appPhraseOverviewSerializer.fromJsonArray(response.data.appPhraseOverviews)
            : [];
    }

    public async getAppPhraseOverview(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        phrase: string,
        signal: AbortSignal | null = null,
    ): Promise<AppPhraseOverview | null> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/phrase/app-overview`,
            {
                sourceLanguageCode,
                targetLanguageCode,
                phrase
            },
            {
                signal,
            }
        );

        return response.status == 200
            ? this.appPhraseOverviewSerializer.fromJson(response.data.appPhraseOverview)
            : null;
    }
}