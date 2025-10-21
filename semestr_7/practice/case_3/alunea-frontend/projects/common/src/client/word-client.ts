import {AxiosService} from "../service/axios-service";
import {ExtensionVideoWordOverviewSerializer} from "../serializer/overview/extension-video-word-overview-serializer";
import {AppWordOverview} from "../entity/external/overview/app-word-overview";
import {AppWordOverviewSerializer} from "../serializer/overview/app-word-overview-serializer";
import {ExtensionVideoWordOverview} from "../entity/external/overview/extension-video-word-overview";
import {TranslationDef} from "../definition/alunea-api-definitions";

export class WordClient
{
    constructor(
        protected clientService: AxiosService,
        protected extensionVideoWordOverviewSerializer: ExtensionVideoWordOverviewSerializer,
        protected appWordOverviewSerializer: AppWordOverviewSerializer
    ) {
    }

    public async markWordAsInStudy(
        userId: string,
        sourceLanguageCode: string,
        word: string,
        phrase: string | null,
        contextIntegration: string,
        contextVideoId: string | null,
        contextVideoName: string | null,
        contextEpisodeName: string | null,
        contextEpisodeNumber: number | null,
        contextVideoTime: number | null,
    ): Promise<boolean> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/word/mark-as-in-study`,
            {
                sourceLanguageCode,
                word,
                ...(phrase && { phrase }),
                ...(contextIntegration && { contextIntegration }),
                ...(contextVideoId && { contextVideoId }),
                ...(contextVideoName && { contextVideoName }),
                ...(contextEpisodeName && { contextEpisodeName }),
                ...(contextEpisodeNumber && { contextEpisodeNumber }),
                ...(contextVideoTime && { contextVideoTime }),
            }
        );

        return response.status == 204;
    }

    public async markWordAsStudied(userId: string, sourceLanguageCode: string, word: string): Promise<boolean> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/word/mark-as-studied`,
            {
                sourceLanguageCode: sourceLanguageCode,
                word: word
            }
        );

        return response.status == 204;
    }

    public async translateWord(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        word: string
    ): Promise<string[] | null> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/word/translate`,
            {
                sourceLanguageCode: sourceLanguageCode,
                targetLanguageCode: targetLanguageCode,
                word: word,
            }
        );

        return response.status == 200 ? response.data.translations : null;
    }

    public async getExtensionVideoWordOverviewByValues(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        word: string,
        contextSourcePhrase: string,
        contextTargetPhrase: string | null,
    ): Promise<ExtensionVideoWordOverview> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/word/extension-video-overview/by-values`,
            {
                sourceLanguageCode,
                targetLanguageCode,
                word,
                contextSourcePhrase,
                contextTargetPhrase,
            }
        );

        if (response.status !== 200) {
            throw new Error(`Unexpected response status: ${response.status}`);
        }

        return this.extensionVideoWordOverviewSerializer.fromJson(response.data.extensionVideoWordOverview);
    }

    public async getAppWordOverviews(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        userWordReferenceStatus: string,
        limit: number,
        offset: number,
        sort: string | null = null,
        query: string | null = null,
        signal: AbortSignal | null = null,
    ): Promise<AppWordOverview[]> {
        const response = await this.clientService.getApiClientInstance().get(
            `/v1/user/${userId}/words/app-overviews`,
            {
                params: {
                    sourceLanguageCode,
                    targetLanguageCode,
                    userWordReferenceStatus,
                    limit,
                    offset,
                    sort,
                    query
                },
                signal
            }
        );

        return response.status == 200
            ? this.appWordOverviewSerializer.fromJsonArray(response.data.appWordOverviews)
            : [];
    }

    public async getAppWordOverview(
        userId: string,
        sourceLanguageCode: string,
        targetLanguageCode: string,
        word: string,
        signal: AbortSignal | null = null,
    ): Promise<AppWordOverview | null> {
        const response = await this.clientService.getApiClientInstance().post(
            `/v1/user/${userId}/word/app-overview`,
            {
                sourceLanguageCode,
                targetLanguageCode,
                word,
            },
            {
                signal,
            }
        );

        return response.status === 200
            ? this.appWordOverviewSerializer.fromJson(response.data.appWordOverview)
            : null;
    }

}