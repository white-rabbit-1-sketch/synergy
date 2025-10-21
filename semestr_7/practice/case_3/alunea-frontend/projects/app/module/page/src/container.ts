import {DeviceService} from "../../../../common/src/service/device-service";
import {NotificationService} from "../../../../common/src/service/notification-service";
import {SerializerService} from "../../../../common/src/service/serializer-service";
import {ChromeApiPlatform} from "../../../../common/src/browser/api/platform/chrome-api-platform";
import {BrowserService} from "../../../../common/src/service/browser-service";
import {LocationService} from "../../../../common/src/service/location-service";
import {ContextService} from "../../../../common/src/service/context-service";
import {AxiosService} from "../../../../common/src/service/axios-service";
import {SecurityClient} from "../../../../common/src/client/security-client";
import {UserClient} from "../../../../common/src/client/user-client";
import {InternalEventService} from "../../../../common/src/service/internal-event-service";
import {TokenService} from "../../../../common/src/service/token-service";
import {RuntimeStoragePlatform} from "../../../../common/src/storage/runtime-storage-platform";
import {LanguageService} from "../../../../common/src/service/language-service";
import {NetflixDomService} from "../../../../common/src/service/netflix-dom-service";
import {NetflixService} from "../../../../common/src/service/netflix-service";
import {UserService} from "../../../../common/src/service/user-service";
import {SecurityService} from "../../../../common/src/service/security-service";
import {SentryService} from "../../../../common/src/service/sentry-service";
import {ErrorHandler} from "../../../../common/src/handler/error-handler";
import {WindowMessageService} from "../../../../common/src/service/window-message-service";
import {WindowMessageObserver} from "../../../../common/src/observer/window-message-observer";
import {HistoryObserver} from "../../../../common/src/observer/history-observer";
import {container} from "../../../../common/src/ioc/container";
import {TimeService} from "../../../../common/src/service/time-service";
import {SafariApiPlatform} from "../../../../common/src/browser/api/platform/safari-api-platform";
import {PlatformService} from "../../../../common/src/service/platform-service";
import {UserOverviewSerializer} from "../../../../common/src/serializer/overview/user-overview-serializer";
import {UserSerializer} from "../../../../common/src/serializer/user-serializer";
import {LanguageSerializer} from "../../../../common/src/serializer/language-serializer";
import {UserLanguageReferenceSerializer} from "../../../../common/src/serializer/user-language-reference-serializer";
import {UserSubscriptionSerializer} from "../../../../common/src/serializer/user-subscription-serializer";
import {PromiseService} from "../../../../common/src/service/promise-service";
import {StorageService} from "../../../../common/src/service/storage-service";
import {LocalStoragePlatform} from "../../../../common/src/storage/local-storage-platform";
import {UrlService} from "../../../../common/src/service/url-service";
import {
    HistoryChangedWindowMessageBridge
} from "../../../../common/src/observer/bridge/message/window/history-changed-window-message-bridge";
import {
    NetflixVideoPlayerReadyObserver
} from "../../../../common/src/observer/integration/netflix/netflix-video-player-ready-observer";
import {
    NetflixVideoPlayerSubtitlesLanguageObserver
} from "../../../../common/src/observer/integration/netflix/netflix-video-player-subtitles-language-observer";
import {
    NetflixVideoPlayerSubtitlesRequestCommandObserver
} from "../../../../common/src/observer/integration/netflix/command/netflix-video-player-subtitles-request-command-observer";
import {
    NetflixVideoPlayerTimeChangeCommandObserver
} from "../../../../common/src/observer/integration/netflix/command/netflix-video-player-time-change-command-observer";
import {NetflixWatcher} from "../../../../common/src/watcher/netflix-watcher";
import {
    NetflixVideoPlayerSubtitlesLanguagesSelectorObserver
} from "../../../../common/src/observer/integration/netflix/netflix-video-player-subtitles-languages-selector-observer";
import {VideoService} from "../../../../common/src/service/video-service";
import {SubtitleService} from "../../../../common/src/service/subtitle-service";
import {CacheService} from "../../../../common/src/service/cache-service";
import {PhraseService} from "../../../../common/src/service/phrase-service";
import {PhraseClient} from "../../../../common/src/client/phrase-client";
import {
    ExtensionVideoPhraseOverviewSerializer
} from "../../../../common/src/serializer/overview/extension-video-phrase-overview-serializer";
import {AppPhraseOverviewSerializer} from "../../../../common/src/serializer/overview/app-phrase-overview-serializer";
import {PhraseSerializer} from "../../../../common/src/serializer/phrase-serializer";
import {SymbolSequenceSerializer} from "../../../../common/src/serializer/symbol-sequence-serializer";
import {WordSerializer} from "../../../../common/src/serializer/word-serializer";
import {PhraseTranslationSerializer} from "../../../../common/src/serializer/phrase-translation-serializer";
import {
    AppNestedPhraseOverviewSerializer
} from "../../../../common/src/serializer/overview/app-nested-phrase-overview-serializer";
import {PhraseSpeechSerializer} from "../../../../common/src/serializer/phrase-speech-serializer";
import {AluneaDomService} from "../../../../common/src/service/alunea-dom-service";
import {FullscreenObserver} from "../../../../common/src/observer/fullscreen-observer";
import {
    VideoPlayerReadyWindowMessageBridge
} from "../../../../common/src/observer/bridge/message/window/video-player-ready-window-message-bridge";
import {
    VideoPlayerSubtitlesLanguageChangedWindowMessageBridge
} from "../../../../common/src/observer/bridge/message/window/video-player-subtitles-language-changed-window-message-bridge";
import {
    NetflixVideoPlayerSubtitlesRequestObserver
} from "../../../../common/src/observer/integration/netflix/netflix-video-player-subtitles-request-observer";
import {
    NetflixVideoPlayerTimeObserver
} from "../../../../common/src/observer/integration/netflix/netflix-video-player-time-observer";
import {WatcherService} from "../../../../common/src/service/watcher-service";
import {
    VideoPlayerSubtitlesReceivedWindowMessageBridge
} from "../../../../common/src/observer/bridge/message/window/video-player-subtitles-received-window-message-bridge";
import {
    SubscriptionPurchaseProductSerializer
} from "../../../../common/src/serializer/subscription-purchase-product-serializer";
import {
    PurchaseProviderProductSerializer
} from "../../../../common/src/serializer/purchase-provider-product-serializer";
import {
    VideoPlayerTimeUpdatedWindowMessageBridge
} from "../../../../common/src/observer/bridge/message/window/video-player-time-updated-window-message-bridge";

const timeService = new TimeService();
const locationService = new LocationService();
const notificationService = new NotificationService();
const chromeApiPlatform = new ChromeApiPlatform();
const safariApiPlatform = new SafariApiPlatform();
const platformService = new PlatformService();
const deviceService = new DeviceService();
const browserService = new BrowserService(chromeApiPlatform, safariApiPlatform, deviceService, platformService);
const contextService = new ContextService();
const serializerService = new SerializerService();
const runtimeStoragePlatform = new RuntimeStoragePlatform(browserService, serializerService);
const localStoragePlatform = new LocalStoragePlatform(serializerService);
const storageService = new StorageService(runtimeStoragePlatform, localStoragePlatform, browserService);
const axiosService = new AxiosService(import.meta.env.VITE_API_URL, notificationService, contextService);
const languageSerializer = new LanguageSerializer();
const userSerializer = new UserSerializer(languageSerializer);
const userLanguageReferenceSerializer = new UserLanguageReferenceSerializer(languageSerializer);
const subscriptionPurchaseProductSerializer = new SubscriptionPurchaseProductSerializer();
const purchaseProviderProductSerializer = new PurchaseProviderProductSerializer(subscriptionPurchaseProductSerializer);
const userSubscriptionSerializer = new UserSubscriptionSerializer(purchaseProviderProductSerializer);
const userOverviewSerializer = new UserOverviewSerializer(userSerializer, userLanguageReferenceSerializer, userSubscriptionSerializer);
const userClient = new UserClient(axiosService, userOverviewSerializer);
const languageService = new LanguageService();
const internalEventService = new InternalEventService();
const promiseService = new PromiseService();
const userService = new UserService(userClient, internalEventService, promiseService);
const securityClient = new SecurityClient(axiosService);
const tokenService = new TokenService();
const securityService = new SecurityService(storageService, userService, securityClient, tokenService, internalEventService, promiseService);
const sentryService = new SentryService(locationService, contextService, securityService);
const errorHandler = new ErrorHandler(notificationService, sentryService, securityService);
const windowMessageService = new WindowMessageService(contextService);
const historyChangedPageMessageObserver = new HistoryObserver(internalEventService, windowMessageService);
const windowMessageObserver = new WindowMessageObserver(windowMessageService);
const netflixService = new NetflixService(languageService, timeService);
const urlService = new UrlService(browserService);
const netflixDom = new NetflixDomService(browserService, urlService);
const netflixVideoPlayerReadyObserver = new NetflixVideoPlayerReadyObserver(netflixService, netflixDom, windowMessageService, timeService);
const netflixVideoPlayerSubtitlesLanguageObserver = new NetflixVideoPlayerSubtitlesLanguageObserver(netflixService, languageService, windowMessageService);
const netflixVideoPlayerSubtitlesRequestCommandObserver = new NetflixVideoPlayerSubtitlesRequestCommandObserver(netflixService, languageService, windowMessageService);
const netflixVideoPlayerTimeChangeCommandObserver = new NetflixVideoPlayerTimeChangeCommandObserver(netflixService, windowMessageService);
const historyChangedWindowMessageBridge = new HistoryChangedWindowMessageBridge(internalEventService, windowMessageService);
const netflixVideoPlayerSubtitlesLanguagesSelectorObserver = new NetflixVideoPlayerSubtitlesLanguagesSelectorObserver(netflixDom, internalEventService);
const subtitleService = new SubtitleService();
const cacheService = new CacheService();
const phraseSerializer = new PhraseSerializer(languageSerializer);
const wordSerializer = new WordSerializer(languageSerializer);
const symbolSequenceSerializer = new SymbolSequenceSerializer(wordSerializer);
const phraseTranslationSerializer = new PhraseTranslationSerializer(languageSerializer);
const phraseSpeechSerializer = new PhraseSpeechSerializer();
const appNestedPhraseOverviewSerializer = new AppNestedPhraseOverviewSerializer(
    phraseSerializer,
    symbolSequenceSerializer,
    phraseTranslationSerializer
);
const extensionVideoPhraseOverviewSerializer = new ExtensionVideoPhraseOverviewSerializer(
    phraseSerializer,
    symbolSequenceSerializer
);
const appPhraseOverviewSerializer = new AppPhraseOverviewSerializer(
    phraseSerializer,
    symbolSequenceSerializer,
    phraseTranslationSerializer,
    appNestedPhraseOverviewSerializer,
    phraseSpeechSerializer
);
const phraseClient = new PhraseClient(axiosService, extensionVideoPhraseOverviewSerializer, appPhraseOverviewSerializer);
const phraseService = new PhraseService(phraseClient, internalEventService, promiseService, cacheService);
const videoService = new VideoService(
    subtitleService,
    securityService,
    languageService,
    notificationService,
    windowMessageService,
    phraseService
);
const aluneaDom = new AluneaDomService();
const fullscreenObserver = new FullscreenObserver(internalEventService);
const videoPlayerReadyWindowMessageBridge = new VideoPlayerReadyWindowMessageBridge(internalEventService, languageService, windowMessageService);
const videoPlayerSubtitlesLanguageChangedWindowMessageBridge = new VideoPlayerSubtitlesLanguageChangedWindowMessageBridge(internalEventService, languageService, windowMessageService);
const netflixSubtitlesRequestObserver = new NetflixVideoPlayerSubtitlesRequestObserver(internalEventService, languageService, timeService, windowMessageService, netflixService);
const netflixVideoPlayerTimeObserver = new NetflixVideoPlayerTimeObserver(netflixDom, netflixService, internalEventService, timeService, windowMessageService);
const videoPlayerSubtitlesReceivedWindowMessageBridge = new VideoPlayerSubtitlesReceivedWindowMessageBridge(internalEventService, languageService, windowMessageService);
const videoPlayerTimeUpdatedWindowMessageBridge = new VideoPlayerTimeUpdatedWindowMessageBridge(internalEventService, windowMessageService);
const netflixWatcher = new NetflixWatcher(
    netflixVideoPlayerReadyObserver,
    netflixVideoPlayerSubtitlesLanguageObserver,
    netflixVideoPlayerTimeChangeCommandObserver,
    netflixVideoPlayerSubtitlesRequestCommandObserver,
    netflixVideoPlayerSubtitlesLanguagesSelectorObserver,
    netflixVideoPlayerTimeObserver,
    netflixSubtitlesRequestObserver,
    netflixDom,
    locationService
);
netflixWatcher.setVideoService(videoService);
netflixWatcher.setSubtitleService(subtitleService);
netflixWatcher.setInternalEventService(internalEventService);
netflixWatcher.setSecurityService(securityService);
netflixWatcher.setAluneaDom(aluneaDom);
netflixWatcher.setFullscreenObserver(fullscreenObserver);
netflixWatcher.setVideoPlayerReadyWindowMessageBridge(videoPlayerReadyWindowMessageBridge);
netflixWatcher.setVideoPlayerSubtitlesLanguageChangedWindowMessageBridge(videoPlayerSubtitlesLanguageChangedWindowMessageBridge);
netflixWatcher.setVideoPlayerSubtitlesReceivedWindowMessageBridge(videoPlayerSubtitlesReceivedWindowMessageBridge);
netflixWatcher.setVideoPlayerTimeUpdatedWindowMessageBridge(videoPlayerTimeUpdatedWindowMessageBridge);

const watcherService = new WatcherService([netflixWatcher]);

axiosService.setSecurityService(securityService);
platformService.setBrowserService(browserService);

container.set(netflixDom);
container.set(netflixService);
container.set(userService);
container.set(notificationService);
container.set(errorHandler);
container.set(languageService);
container.set(runtimeStoragePlatform);
container.set(serializerService);
container.set(browserService);
container.set(locationService);
container.set(securityClient);
container.set(tokenService);
container.set(securityService);
container.set(internalEventService);
container.set(contextService);
container.set(netflixVideoPlayerReadyObserver);
container.set(sentryService);
container.set(deviceService);
container.set(windowMessageService);
container.set(windowMessageObserver);
container.set(historyChangedPageMessageObserver);
container.set(safariApiPlatform);
container.set(platformService);
container.set(timeService);
container.set(userOverviewSerializer);
container.set(userSerializer);
container.set(languageSerializer);
container.set(userLanguageReferenceSerializer);
container.set(userSubscriptionSerializer);
container.set(promiseService);
container.set(storageService);
container.set(localStoragePlatform);
container.set(urlService);
container.set(historyChangedWindowMessageBridge);
container.set(netflixVideoPlayerSubtitlesLanguageObserver);
container.set(netflixVideoPlayerSubtitlesRequestCommandObserver);
container.set(netflixVideoPlayerTimeChangeCommandObserver);
container.set(netflixWatcher);
container.set(watcherService);
container.set(videoPlayerSubtitlesReceivedWindowMessageBridge);
container.set(subscriptionPurchaseProductSerializer);
container.set(purchaseProviderProductSerializer);

export { container };