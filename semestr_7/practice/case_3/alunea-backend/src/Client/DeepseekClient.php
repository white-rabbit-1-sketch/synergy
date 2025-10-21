<?php

namespace App\Client;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;

class DeepseekClient
{
    public function __construct(
        protected LoggerInterface $logger,
        protected Client $deepseekClient
    )
    {
    }

    public function chat(array $messages): PromiseInterface
    {
        $this->logger->info('Deepseek client chat request', [
            'messages' => $messages
        ]);

        $promise = $this->deepseekClient->postAsync('/v1/chat/completions', [
            'json' => [
                'model' => 'deepseek-chat',
                'messages' => $messages,
                'response_format' => [
                    'type' => 'json_object'
                ],
                'stream' => false,
            ],
        ]);

        return $promise->then(
            function (ResponseInterface $response) use ($messages) {
                $response = json_decode($response->getBody()->getContents(), true);

                $this->logger->info('Deepseek client chat response', [
                    'messages' => $messages,
                    'response' => $response
                ]);

                return $response;
            }
        );
    }
}