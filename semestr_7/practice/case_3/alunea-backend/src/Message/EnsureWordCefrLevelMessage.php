<?php

namespace App\Message;

class EnsureWordCefrLevelMessage
{
    public function __construct(
        protected string $sourceLanguageCode,
        protected string $wordValue,
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

    public function getWordValue(): string
    {
        return $this->wordValue;
    }

    public function setWordValue(string $wordValue): void
    {
        $this->wordValue = $wordValue;
    }
}