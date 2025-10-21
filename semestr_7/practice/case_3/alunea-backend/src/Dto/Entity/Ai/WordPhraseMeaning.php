<?php

namespace App\Dto\Entity\Ai;

class WordPhraseMeaning
{
    protected string $meaning;

    public function __construct(string $meaning)
    {
        $this->meaning = $meaning;
    }

    public function getMeaning(): string
    {
        return $this->meaning;
    }

    public function setMeaning(string $meaning): void
    {
        $this->meaning = $meaning;
    }
}