<?php

namespace App\Dto\Entity\Ai;

use App\Entity\Phrase;

class PhraseCefrLevel
{
    public function __construct(
        protected Phrase $phrase,
        protected string $cefrLevel
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

    public function getCefrLevel(): string
    {
        return $this->cefrLevel;
    }

    public function setCefrLevel(string $cefrLevel): void
    {
        $this->cefrLevel = $cefrLevel;
    }
}