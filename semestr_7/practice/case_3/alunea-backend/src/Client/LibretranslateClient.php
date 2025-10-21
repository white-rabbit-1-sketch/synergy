<?php

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class LibretranslateClient
{
    public function __construct(
        protected LoggerInterface $logger,
        protected Client $libretranslateClient
    )
    {
    }

    public function translate(
        string $sourceLanguage,
        string $targetLanguage,
        string $sourceValue,
    ): PromiseInterface
    {
        $this->logger->info('Libretranslate client request', [
            'sourceLanguage' => $sourceLanguage,
            'targetLanguage' => $targetLanguage,
            'sourceValue' => $sourceValue,
        ]);

        $promise = $this->libretranslateClient->postAsync('/translate', [
            'json' => [
                'source' => $sourceLanguage,
                'target' => $targetLanguage,
                'q' => $sourceValue,
                'format' => 'text',
            ],
        ]);

        return $promise->then(
            function (ResponseInterface $response) use ($sourceLanguage, $targetLanguage, $sourceValue) {
                $response = json_decode($response->getBody()->getContents(), true);

                $this->logger->info('Libretranslate client response', [
                    'sourceLanguage' => $sourceLanguage,
                    'targetLanguage' => $targetLanguage,
                    'response' => $response,
                ]);

                if (!$response['translatedText']) {
                    throw new \Exception('Failed to translate by libretranslate');
                }

                return $response['translatedText'];
            }
        );
    }
}