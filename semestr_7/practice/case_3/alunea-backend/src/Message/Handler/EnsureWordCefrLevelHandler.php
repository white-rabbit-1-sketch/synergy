<?php

namespace App\Message\Handler;

use App\Message\EnsureWordCefrLevelMessage;
use App\Service\LanguageService;
use App\Service\WordService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class EnsureWordCefrLevelHandler
{
    public function __construct(
        protected LanguageService $languageService,
        protected WordService $wordService
    )
    {
    }

    public function __invoke(EnsureWordCefrLevelMessage $message)
    {
        $sourceLanguage = $this->languageService->getLanguageByCode($message->getSourceLanguageCode());
        if (!$sourceLanguage) {
            throw new \Exception('Source language not found');
        }

        $word = $this->wordService->getWordByLanguageAndValue($sourceLanguage, $message->getWordValue());
        if (!$word) {
            throw new \Exception('Word not found');
        }

        $this->wordService->ensureWordCefrLevel($word)->wait();
    }
}