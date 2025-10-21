<?php

namespace App\Message;

class EnsureWordsMessage
{
    public function __construct(
        protected string $sourceLanguageCode,
        protected array $wordValues,
    ) {
    }

    public function getSourceLanguageCode(): string
    {
        return $this->sourceLanguageCode;
    }

    public function setSourceLanguageCode(string $sourceLanguageCode): void
    {
        $this->sourceLanguageCode = $sourceLanguageCode;
    }

    public function getWordValues(): array
    {
        return $this->wordValues;
    }

    public function setWordValues(array $wordValues): void
    {
        $this->wordValues = $wordValues;
    }
}