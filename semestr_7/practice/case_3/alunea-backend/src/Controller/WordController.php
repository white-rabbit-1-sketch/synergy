<?php

namespace App\Controller;

use App\Dto\Controller\Request\Translation\TranslateWordRequestDto;
use App\Dto\Controller\Request\Word\EnsureExtensionVideoWordOverviewByValuesRequestDto;
use App\Dto\Controller\Request\Word\GetAppWordOverviewRequestDto;
use App\Dto\Controller\Request\Word\GetAppWordOverviewsRequestDto;
use App\Dto\Controller\Request\Word\MarkWordAsInStudyRequestDto;
use App\Dto\Controller\Request\Word\MarkWordAsStudiedRequestDto;
use App\Dto\Controller\Response\Translation\TranslateWordResponseDto;
use App\Dto\Controller\Response\Word\EnsureExtensionVideoWordOverviewByValuesResponseDto;
use App\Dto\Controller\Response\Word\GetAppWordOverviewResponseDto;
use App\Dto\Controller\Response\Word\GetAppWordOverviewsResponseDto;
use App\Entity\User;
use App\Entity\WordTranslationCache;
use App\Enum\SerializerContextEnum;
use App\Exception\Http\SubscriptionRequiredHttpException;
use App\Exception\Http\TooManyRequestsHttpException;
use App\Service\LanguageService;
use App\Service\Overview\AppWordOverviewService;
use App\Service\Overview\ExtensionVideoWordOverviewService;
use App\Service\PhraseService;
use App\Service\TranslationService;
use App\Service\UserSubscriptionService;
use App\Service\UserWordReferenceService;
use App\Service\WordPhraseTranslationService;
use App\Service\WordService;
use App\Service\WordTranslationService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(format: 'json')]
class WordController extends AbstractController
{
    public function __construct(
        protected WordService                       $wordService,
        protected PhraseService                     $phraseService,
        protected UserWordReferenceService          $userWordReferenceService,
        protected LanguageService                   $languageService,
        protected WordPhraseTranslationService      $wordPhraseTranslationService,
        protected WordTranslationService            $wordTranslationService,
        protected ExtensionVideoWordOverviewService $extensionVideoWordOverviewService,
        protected UserSubscriptionService           $userSubscriptionService,
        protected AppWordOverviewService            $appWordOverviewService,
        protected RateLimiterFactory                $aluneaApiWordMarkWordAsInStudyLimiter,
        protected RateLimiterFactory                $aluneaApiWordTranslateWordLimiter,
        protected RateLimiterFactory                $aluneaApiWordBuildExtensionVideoWordOverviewByValuesLimiter,
        protected RateLimiterFactory                $aluneaApiWordMarkWordAsInStudyUserWithoutSubscriptionLimiter,
        protected TranslationService                $translationService
    )
    {
    }

    #[Route('/v1/user/{userId}/word/mark-as-in-study', methods: ['POST'])]
    #[IsGranted('ROLE_USER', message: 'Unauthorized', statusCode: 401)]
    public function markWordAsInStudy(
        Request $request,
        #[MapEntity(mapping: ['userId' => 'id'])] User $user,
        #[MapRequestPayload] MarkWordAsInStudyRequestDto $markWordAsInStudyRequestDto,
    ): Response
    {
        if ($this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException('Access denied');
        }

        $limiter = $this->aluneaApiWordMarkWordAsInStudyLimiter->create($user->getId());
        if ($limiter->consume()->isAccepted() === false) {
            throw new TooManyRequestsHttpException();
        }

        $language = $this->languageService->getLanguageByCode(
            $markWordAsInStudyRequestDto->getSourceLanguageCode()
        );
        if (!$language) {
            throw new UnprocessableEntityHttpException('Language not found');
        }

        $userWordReference = $this->userWordReferenceService->getUserWordReferenceByUserAndLanguageAndWordValue(
            $user,
            $language,
            $markWordAsInStudyRequestDto->getWord()
        );
        $isUserSubscriptionActive = $this->userSubscriptionService->isUserHasActiveSubscription($user);
        if (!$isUserSubscriptionActive && !$userWordReference) {
            $limiter = $this->aluneaApiWordMarkWordAsInStudyUserWithoutSubscriptionLimiter->create($user->getId());
            if ($limiter->consume()->isAccepted() === false) {
                throw new SubscriptionRequiredHttpException();
            }
        }

        $this->userWordReferenceService->markWordAsInStudy(
            $user,
            $language,
            $markWordAsInStudyRequestDto->getWord(),
            $markWordAsInStudyRequestDto->getContextIntegration(),
            $markWordAsInStudyRequestDto->getPhrase(),
            $markWordAsInStudyRequestDto->getContextVideoId(),
            $markWordAsInStudyRequestDto->getContextVideoName(),
            $markWordAsInStudyRequestDto->getContextEpisodeName(),
            $markWordAsInStudyRequestDto->getContextEpisodeNumber(),
            $markWordAsInStudyRequestDto->getContextVideoTime(),
        );

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/v1/user/{userId}/word/mark-as-studied', methods: ['POST'])]
    #[IsGranted('ROLE_USER', message: 'Unauthorized', statusCode: 401)]
    public function markWordAsStudied(
        #[MapEntity(mapping: ['userId' => 'id'])] User $user,
        #[MapRequestPayload] MarkWordAsStudiedRequestDto $markWordAsStudiedRequestDto,
    ): Response
    {
        if ($this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException('Access denied');
        }

        $language = $this->languageService->getLanguageByCode(
            $markWordAsStudiedRequestDto->getSourceLanguageCode()
        );
        if (!$language) {
            throw new UnprocessableEntityHttpException('Language not found');
        }

        $word = $this->wordService->getWordByLanguageAndValue(
            $language,
            $markWordAsStudiedRequestDto->getWord()
        );
        if (!$word) {
            throw new NotFoundHttpException('Word not found');
        }

        $this->userWordReferenceService->markWordAsStudied($user, $word);

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}