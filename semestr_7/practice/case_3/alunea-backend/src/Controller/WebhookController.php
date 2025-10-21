<?php

namespace App\Controller;

use App\Enum\ProviderEnum;
use App\Service\ProviderService;
use App\Service\WebhookService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(format: 'json')]
class WebhookController extends AbstractController
{
    public function __construct(
        protected WebhookService $webhookService,
        protected ProviderService $providerService,
    )
    {
    }

    #[Route('/v1/webhook/handle/{provider}', methods: ['POST'])]
    public function handleWebhook(
        Request $request,
        string $provider
    ): Response
    {
        $provider = $this->providerService->getProviderByCode($provider);
        if (!$provider) {
            $this->createNotFoundException();
        }

        $webhook = $this->webhookService->buildWebhook(
            $provider,
            json_decode($request->getContent(), true) ?? []
        );
        $this->webhookService->handleWebhook($webhook);

        return new Response();
    }
}