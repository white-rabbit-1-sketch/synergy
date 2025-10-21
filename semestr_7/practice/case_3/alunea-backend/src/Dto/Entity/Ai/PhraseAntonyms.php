<?php

namespace App\Dto\Entity\Ai;

class PhraseAntonyms
{
    /** @var string[] */
    protected array $antonyms;

    public function __construct(array $antonyms)
    {
        $this->antonyms = $antonyms;
    }

    public function getAntonyms(): array
    {
        return $this->antonyms;
    }

    public function setAntonyms(array $antonyms): void
    {
        $this->antonyms = $antonyms;
    }
}