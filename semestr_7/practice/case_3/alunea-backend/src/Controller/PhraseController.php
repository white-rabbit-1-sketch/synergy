<?php

namespace App\Controller;

use App\Dto\Controller\Request\Phrase\BuildExtensionVideoPhraseOverviewsByValuesRequestDto;
use App\Dto\Controller\Request\Phrase\GetAppPhraseOverviewRequestDto;
use App\Dto\Controller\Request\Phrase\GetAppPhraseOverviewsRequestDto;
use App\Dto\Controller\Request\Phrase\MarkPhraseAsInStudyRequestDto;
use App\Dto\Controller\Request\Phrase\MarkPhraseAsStudiedRequestDto;
use App\Dto\Controller\Request\Translation\TranslatePhrasesRequestDto;
use App\Dto\Controller\Response\Phrase\BuildExtensionVideoPhraseOverviewsResponseDto;
use App\Dto\Controller\Response\Phrase\GetAppPhraseOverviewResponseDto;
use App\Dto\Controller\Response\Phrase\GetAppPhraseOverviewsResponseDto;
use App\Dto\Controller\Response\Translation\TranslatePhrasesResponseDto;
use App\Entity\PhraseTranslationCache;
use App\Entity\User;
use App\Enum\SerializerContextEnum;
use App\Exception\Http\SubscriptionRequiredHttpException;
use App\Exception\Http\TooManyRequestsHttpException;
use App\Message\EnsureWordsMessage;
use App\Service\LanguageService;
use App\Service\Overview\AppPhraseOverviewService;
use App\Service\Overview\ExtensionVideoPhraseOverviewService;
use App\Service\PhraseService;
use App\Service\TranslationService;
use App\Service\UserPhraseReferenceService;
use App\Service\UserSubscriptionService;
use App\Service\UserWordReferenceService;
use App\Service\WordService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(format: 'json')]
class PhraseController extends AbstractController
{
    public function __construct(
        protected LanguageService                     $languageService,
        protected PhraseService                       $phraseService,
        protected UserPhraseReferenceService          $userPhraseReferenceService,
        protected UserWordReferenceService            $userWordReferenceService,
        protected WordService                         $wordService,
        protected MessageBusInterface                 $messageBus,
        protected ExtensionVideoPhraseOverviewService $extensionVideoPhraseOverviewService,
        protected UserSubscriptionService             $userSubscriptionService,
        protected AppPhraseOverviewService            $appPhraseOverviewService,
        protected RateLimiterFactory                  $aluneaApiPhraseMarkPhraseAsInStudyLimiter,
        protected RateLimiterFactory                  $aluneaApiPhraseMarkPhraseAsInStudyUserWithoutSubscriptionLimiter,
        protected RateLimiterFactory                  $aluneaApiPhraseTranslatePhrasesLimiter,
        protected TranslationService                  $translationService
    )
    {
    }

    #[Route('/v1/user/{userId}/phrase/mark-as-in-study', methods: ['POST'])]
    #[IsGranted('ROLE_USER', message: 'Unauthorized', statusCode: 401)]
    public function markPhraseAsInStudy(
        Request $request,
        #[MapEntity(mapping: ['userId' => 'id'])] User $user,
        #[MapRequestPayload] MarkPhraseAsInStudyRequestDto $markPhraseAsInStudyRequestDto,
    ): Response
    {
        if ($this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException('Access denied');
        }

        $limiter = $this->aluneaApiPhraseMarkPhraseAsInStudyLimiter->create($user->getId());
        if ($limiter->consume()->isAccepted() === false) {
            throw new TooManyRequestsHttpException();
        }

        $language = $this->languageService->getLanguageByCode(
            $markPhraseAsInStudyRequestDto->getSourceLanguageCode()
        );
        if (!$language) {
            throw new UnprocessableEntityHttpException('Language not found');
        }

        $userPhraseReference = $this->userPhraseReferenceService->getUserPhraseReferenceByUserAndLanguageAndPhraseValue(
            $user,
            $language,
            $markPhraseAsInStudyRequestDto->getPhrase(),
        );
        $isUserSubscriptionActive = $this->userSubscriptionService->isUserHasActiveSubscription($user);
        if (!$isUserSubscriptionActive && !$userPhraseReference) {
            $limiter = $this->aluneaApiPhraseMarkPhraseAsInStudyUserWithoutSubscriptionLimiter->create($user->getId());
            if ($limiter->consume()->isAccepted() === false) {
                throw new SubscriptionRequiredHttpException();
            }
        }

        $this->userPhraseReferenceService->markPhraseAsInStudy(
            $user,
            $language,
            $markPhraseAsInStudyRequestDto->getPhrase(),
            $markPhraseAsInStudyRequestDto->getContextIntegration(),
            $markPhraseAsInStudyRequestDto->getContextVideoId(),
            $markPhraseAsInStudyRequestDto->getContextVideoName(),
            $markPhraseAsInStudyRequestDto->getContextEpisodeName(),
            $markPhraseAsInStudyRequestDto->getContextEpisodeNumber(),
            $markPhraseAsInStudyRequestDto->getContextVideoTime(),
        );

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/v1/user/{userId}/phrase/mark-as-studied', methods: ['POST'])]
    #[IsGranted('ROLE_USER', message: 'Unauthorized', statusCode: 401)]
    public function markPhraseAsStudied(
        #[MapEntity(mapping: ['userId' => 'id'])] User     $user,
        #[MapRequestPayload] MarkPhraseAsStudiedRequestDto $markPhraseAsStudiedRequestDto,
    ): Response
    {
        if ($this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException('Access denied');
        }

        $language = $this->languageService->getLanguageByCode(
            $markPhraseAsStudiedRequestDto->getSourceLanguageCode()
        );
        if (!$language) {
            throw new UnprocessableEntityHttpException('Language not found');
        }

        $phrase = $this->phraseService->getPhraseByLanguageAndValue(
            $language,
            $markPhraseAsStudiedRequestDto->getPhrase()
        );
        if (!$phrase) {
            throw new NotFoundHttpException('Phrase not found');
        }

        $this->userPhraseReferenceService->markPhraseAsStudied($user, $phrase);

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}