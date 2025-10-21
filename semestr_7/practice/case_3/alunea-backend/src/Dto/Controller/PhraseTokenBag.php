<?php

namespace App\Dto\Controller;

use App\Entity\Language;

class PhraseTokenBag
{
    public function __construct(
        protected Language $sourceLanguage,
        protected string $sourceValue,
        protected array $tokens,
    ) {
    }

    public function getSourceLanguage(): Language
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage(Language $sourceLanguage): void
    {
        $this->sourceLanguage = $sourceLanguage;
    }

    public function getSourceValue(): string
    {
        return $this->sourceValue;
    }

    public function setSourceValue(string $sourceValue): void
    {
        $this->sourceValue = $sourceValue;
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }

    public function setTokens(array $tokens): void
    {
        $this->tokens = $tokens;
    }
}