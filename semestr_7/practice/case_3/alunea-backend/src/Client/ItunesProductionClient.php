<?php

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class ItunesProductionClient
{
    public function __construct(
        protected LoggerInterface $logger,
        protected string $apiKey,
        protected Client $itunesClient
    )
    {
    }

    public function getReceipt(
        string $receiptData,
    ): PromiseInterface
    {
        $this->logger->info('Itunes client request', [
            'receiptData' => $receiptData,
        ]);

        $promise = $this->itunesClient->postAsync('/verifyReceipt', [
            'json' => [
                'receipt-data' => $receiptData,
                'password' => $this->apiKey,
                'exclude-old-transactions' => true,
            ],
        ]);

        return $promise->then(
            function (ResponseInterface $response) use ($receiptData) {
                $response = json_decode($response->getBody()->getContents(), true);

                $this->logger->info('Itunes client response', [
                    'receiptData' => $receiptData,
                    'response' => $response,
                ]);

                return $response;
            }
        );
    }
}