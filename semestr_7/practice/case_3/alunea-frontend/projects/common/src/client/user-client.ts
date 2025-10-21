import {AxiosService} from "../service/axios-service";
import {UserOverview} from "../entity/external/overview/user-overview";
import {UserOverviewSerializer} from "../serializer/overview/user-overview-serializer";

export class UserClient
{
    constructor(
        protected clientService: AxiosService,
        protected userOverviewSerializer: UserOverviewSerializer
    ) {
    }

    public async getUserOverview(id: string): Promise<UserOverview> {
        const response = await this.clientService.getApiClientInstance().get(`/v1/user/${id}/overview`);

        return this.userOverviewSerializer.fromJson(response.data.userOverview);
    }

    public async createUser(email: string, password: string, nativeLanguageCode: string | null = null): Promise<boolean> {
        const response = await this.clientService.getApiClientInstance().post(
            '/v1/user',
            {
                email: email,
                password: password,
                nativeLanguageCode: nativeLanguageCode
            }
        );

        return response.status == 200;
    }

    public async updateUserNativeLanguage(id: string, nativeLanguageCode: string): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${id}/native-language`,
            {
                nativeLanguageCode: nativeLanguageCode
            }
        );
    }

    public async updateUserLanguageReferenceManualCefrLevel(
        userId: string,
        languageCode: string,
        manualCefrLevel: string | null
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/language-reference/${languageCode}/manual-cefr-level`,
            {
                manualCefrLevel: manualCefrLevel
            }
        );
    }

    public async updateUserShowSecondarySubtitles(
        userId: string,
        showSecondarySubtitles: boolean
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/show-secondary-subtitles`,
            {
                showSecondarySubtitles: showSecondarySubtitles
            }
        );
    }

    public async updateUserHighlightRecommendedWords(
        userId: string,
        highlightRecommendedWords: boolean
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/highlight-recommended-words`,
            {
                highlightRecommendedWords: highlightRecommendedWords
            }
        );
    }

    public async updateUserHighlightWordsInStudy(
        userId: string,
        highlightWordsInStudy: boolean
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/highlight-words-in-study`,
            {
                highlightWordsInStudy: highlightWordsInStudy
            }
        );
    }

    public async updateUserPrimarySubtitleSize(
        userId: string,
        primarySubtitleSize: string
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/primary-subtitle-size`,
            {
                primarySubtitleSize: primarySubtitleSize
            }
        );
    }

    public async updateUserSecondarySubtitleSize(
        userId: string,
        secondarySubtitleSize: string
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/secondary-subtitle-size`,
            {
                secondarySubtitleSize: secondarySubtitleSize
            }
        );
    }

    public async updateUserOptIn(
        userId: string,
        optIn: boolean
    ): Promise<void> {
        await this.clientService.getApiClientInstance().put(
            `/v1/user/${userId}/opt-in`,
            {
                optIn: optIn
            }
        );
    }
}