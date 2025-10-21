<?php

namespace App\Dto\Entity\Overview;

use App\Entity\Language;
use App\Entity\Word;

class ExtensionVideoWordOverview
{
    public function __construct(
        protected Word $word,
        /** @var string[] */
        protected array $translations,
        protected string $contextTranslation,
        protected Language $targetLanguage
    )
    {
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }

    public function getContextTranslation(): string
    {
        return $this->contextTranslation;
    }

    public function setContextTranslation(string $contextTranslation): void
    {
        $this->contextTranslation = $contextTranslation;
    }

    public function getTargetLanguage(): Language
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(Language $targetLanguage): void
    {
        $this->targetLanguage = $targetLanguage;
    }
}