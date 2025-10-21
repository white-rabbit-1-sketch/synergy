import {AxiosService} from "../service/axios-service";
import {HandleAppVersionResponse} from "../definition/alunea-api-definitions";

export class VersionClient
{
    constructor(
        protected clientService: AxiosService,
    ) {
    }

    public async handleAppVersion(version: string): Promise<HandleAppVersionResponse> {
        const response = await this.clientService.getApiClientInstance().post(
            '/v1/version/app',
            {
                version: version,
            }
        );

        return response.data;
    }
}