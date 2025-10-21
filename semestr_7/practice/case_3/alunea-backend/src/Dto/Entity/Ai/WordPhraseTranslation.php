<?php

namespace App\Dto\Entity\Ai;

class WordPhraseTranslation
{
    protected string $wordTranslation;

    public function __construct(string $wordTranslation)
    {
        $this->wordTranslation = $wordTranslation;
    }

    public function getWordTranslation(): string
    {
        return $this->wordTranslation;
    }

    public function setWordTranslation(string $wordTranslation): void
    {
        $this->wordTranslation = $wordTranslation;
    }
}