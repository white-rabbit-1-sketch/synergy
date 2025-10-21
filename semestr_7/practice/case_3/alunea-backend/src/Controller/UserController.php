<?php

namespace App\Controller;

use App\Dto\Controller\Request\User\CreateUserRequestDto;
use App\Dto\Controller\Request\User\SetManualCefrLevelRequestDto;
use App\Dto\Controller\Request\User\UpdateUserHighlightRecommendedWordsRequestDto;
use App\Dto\Controller\Request\User\UpdateUserHighlightWordsInStudyRequestDto;
use App\Dto\Controller\Request\User\UpdateUserOptInRequestDto;
use App\Dto\Controller\Request\User\UpdateUserPrimarySubtitleSizeRequestDto;
use App\Dto\Controller\Request\User\UpdateUserSecondarySubtitleSizeRequestDto;
use App\Dto\Controller\Request\User\UpdateUserShowSecondarySubtitlesRequestDto;
use App\Dto\Controller\Request\User\UpdateUserNativeLanguageRequestDto;
use App\Dto\Controller\Response\User\CreateUserResponseDto;
use App\Dto\Controller\Response\User\GetUserOverviewResponseDto;
use App\Dto\Controller\Response\User\IsUserEmailAvailableResponseDto;
use App\Exception\Http\TooManyRequestsHttpException;
use App\Exception\Http\UserExistsHttpException;
use App\Service\LanguageService;
use App\Service\LockService;
use App\Service\Overview\UserOverviewService;
use App\Service\UserLanguageReferenceService;
use App\Service\UserPhraseReferenceService;
use App\Service\UserService;
use App\Service\UserWordReferenceService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(format: 'json')]
class UserController extends AbstractController
{
    public function __construct(
        protected UserService $userService,
        protected LanguageService $languageService,
        protected LockService $lockService,
        protected UserLanguageReferenceService $userLanguageReferenceService,
        protected UserWordReferenceService $userWordReferenceService,
        protected UserPhraseReferenceService $userPhraseReferenceService,
        protected UserOverviewService $userOverviewService,
        protected RateLimiterFactory $aluneaApiUserCreateUserLimiter,
        protected RateLimiterFactory $aluneaApiUserIsUserEmailAvailableLimiter,
    )
    {
    }

    #[Route('/v1/user', methods: ['POST'])]
    public function createUser(
        Request $request,
        #[MapRequestPayload] CreateUserRequestDto $createUserRequestDto
    ): JsonResponse
    {
        $limiter = $this->aluneaApiUserCreateUserLimiter->create($request->getClientIp());
        if ($limiter->consume()->isAccepted() === false) {
            throw new TooManyRequestsHttpException();
        }

        $user = $this->lockService->wrapInLock(
            $this->lockService->createUserCreateLock($createUserRequestDto->getEmail()),
            function () use ($request, $createUserRequestDto) {
                if ($this->userService->getUserByEmail($createUserRequestDto->getEmail())) {
                    throw new UserExistsHttpException();
                }

                $nativeLanguage = $createUserRequestDto->getNativeLanguageCode()
                    ? $this->languageService->getLanguageByCode($createUserRequestDto->getNativeLanguageCode())
                    : null;

                return $this->userService->createUser(
                    $createUserRequestDto->getEmail(),
                    $createUserRequestDto->getPassword(),
                    $request->getClientIp(),
                    $nativeLanguage
                );
            }
        );

        return $this->json(new CreateUserResponseDto($this->userOverviewService->buildUserOverview($user)));
    }

    #[Route('/v1/user/email/{email}', methods: ['GET'])]
    public function isUserEmailAvailable(Request $request, string $email): JsonResponse
    {
        $limiter = $this->aluneaApiUserIsUserEmailAvailableLimiter->create($request->getClientIp());
        if ($limiter->consume()->isAccepted() === false) {
            throw new TooManyRequestsHttpException();
        }

        return $this->json(new IsUserEmailAvailableResponseDto(
            !$this->userService->getUserByEmail($email)
        ));
    }
}