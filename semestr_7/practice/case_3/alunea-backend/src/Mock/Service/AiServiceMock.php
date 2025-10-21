<?php

namespace App\Mock\Service;

use App\Dto\Entity\Ai\WordCefrLevel;
use App\Service\AiService;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;

class AiServiceMock extends AiService
{
    public function normalizeWords(array $words): PromiseInterface
    {
        $result = [];
        $levels = ['A1', 'A2', 'B1', 'B2', 'C1'];

        foreach ($words as $word) {
            $result[] = new WordCefrLevel($word, $levels[array_rand($levels)]);
        }

        return new FulfilledPromise($result);
    }
}