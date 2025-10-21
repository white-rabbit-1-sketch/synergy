import {container} from "../../../../common/src/ioc/container";
import {ContextService} from "../../../../common/src/service/context-service";
import {BrowserService} from "../../../../common/src/service/browser-service";
import {ChromeApiPlatform} from "../../../../common/src/browser/api/platform/chrome-api-platform";
import {SafariApiPlatform} from "../../../../common/src/browser/api/platform/safari-api-platform";
import {DeviceService} from "../../../../common/src/service/device-service";
import {PlatformService} from "../../../../common/src/service/platform-service";

const contextService = new ContextService();
const chromeApiPlatform = new ChromeApiPlatform();
const safariApiPlatform = new SafariApiPlatform();
const deviceService = new DeviceService();
const platformService = new PlatformService();
const browserService = new BrowserService(chromeApiPlatform, safariApiPlatform, deviceService, platformService);

platformService.setBrowserService(browserService);

container.set(contextService);
container.set(browserService);
container.set(platformService);

export { container };