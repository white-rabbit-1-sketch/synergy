<?php

namespace App\Dto\Entity\Ai;

use App\Entity\Word;

class WordCefrLevel
{
    public function __construct(
        protected Word $word,
        protected string $cefrLevel
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

    public function getCefrLevel(): string
    {
        return $this->cefrLevel;
    }

    public function setCefrLevel(string $cefrLevel): void
    {
        $this->cefrLevel = $cefrLevel;
    }
}