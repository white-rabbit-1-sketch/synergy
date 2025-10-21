<?php

namespace App\Service;

use App\Entity\Provider;
use App\Entity\Webhook;
use App\Enum\WebhookStatusEnum;
use App\Repository\WebhookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Clock\DatePoint;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class WebhookService
{
    public function __construct(
        protected WebhookRepository        $webhookRepository,
        protected EntityManagerInterface   $entityManager,
        protected DatabaseService          $databaseService,
        protected LoggerInterface          $logger,
        protected EventDispatcherInterface $eventDispatcher,
        #[AutowireIterator('webhook.handler')]
        protected iterable $webhookHandlers
    )
    {
    }

    public function buildWebhook(
        Provider $provider,
        array $payload
    ): Webhook {
        $purchaseWebhook = new Webhook();
        $purchaseWebhook->setProvider($provider);
        $purchaseWebhook->setPayload($payload);
        $purchaseWebhook->setCreateTime(new DatePoint());

        return $purchaseWebhook;
    }

    public function handleWebhook(Webhook $webhook): void
    {
        try {
            $this->entityManager->beginTransaction();

            $webhook->setStatus(WebhookStatusEnum::HANDLED);
            $this->webhookRepository->save($webhook);

            $isHandled = false;
            foreach ($this->webhookHandlers as $handler) {
                if ($handler->support($webhook)) {
                    $handler->handle($webhook);
                    $isHandled = true;
                }
            }

            if (!$isHandled) {
                throw new \Exception('Webhook not supported');
            }

            $this->webhookRepository->save($webhook);

            $this->entityManager->commit();
        } catch (\Throwable $exception) {
            $this->entityManager->rollback();

            $this->logger->error('Webhook handler error: ' . $exception->getMessage(), [
                'purchaseWebhookId' => $webhook->getId(),
                'provider' => $webhook->getProvider()->getCode(),
            ]);

            $this->entityManager->detach($webhook);
            $this->entityManager = $this->databaseService->resetEntityManager();

            $webhook->setStatus(WebhookStatusEnum::FAILED);
            $webhook->setStatusReason($exception->getMessage() . "\n" . $exception->getTraceAsString());
            $this->webhookRepository->save($webhook);

            throw $exception;
        }
    }
}