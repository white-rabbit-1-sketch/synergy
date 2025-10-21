<?php

namespace App\Controller;

use App\Dto\Controller\Request\Version\HandleAppVersionRequestDto;
use App\Dto\Controller\Response\Version\HandleAppVersionResponseDto;
use App\Service\VersionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(format: 'json')]
class VersionController extends AbstractController
{
    public function __construct(
        protected VersionService $versionService
    )
    {
    }

    #[Route('/v1/version/app', methods: ['POST'])]
    public function handleAppVersion(
        #[MapRequestPayload] HandleAppVersionRequestDto $handleAppVersionRequestDto,
    ): JsonResponse
    {
        return $this->json(new HandleAppVersionResponseDto(
            $this->versionService->isAppVersionUpdateAvailable($handleAppVersionRequestDto->getVersion()),
            $this->versionService->isAppVersionSupported($handleAppVersionRequestDto->getVersion())
        ));
    }
}