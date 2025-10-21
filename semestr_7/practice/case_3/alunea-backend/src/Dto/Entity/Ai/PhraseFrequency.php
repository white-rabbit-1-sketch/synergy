<?php

namespace App\Dto\Entity\Ai;

use App\Entity\Phrase;

class PhraseFrequency
{
    public function __construct(
        protected Phrase $phrase,
        protected int $frequency
    )
    {
    }

    public function getPhrase(): Phrase
    {
        return $this->phrase;
    }

    public function setPhrase(Phrase $phrase): void
    {
        $this->phrase = $phrase;
    }

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    public function setFrequency(int $frequency): void
    {
        $this->frequency = $frequency;
    }
}