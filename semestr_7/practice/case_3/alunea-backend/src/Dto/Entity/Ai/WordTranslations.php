<?php

namespace App\Dto\Entity\Ai;

class WordTranslations
{
    /** @var string[] */
    protected array $translations = [];

    public function __construct(array $translations)
    {
        $this->translations = $translations;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }
}