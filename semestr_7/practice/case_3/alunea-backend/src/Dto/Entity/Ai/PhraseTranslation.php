<?php

namespace App\Dto\Entity\Ai;

class PhraseTranslation
{
    public function __construct(
        protected string $translation
    )
    {
    }

    public function getTranslation(): string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): void
    {
        $this->translation = $translation;
    }
}