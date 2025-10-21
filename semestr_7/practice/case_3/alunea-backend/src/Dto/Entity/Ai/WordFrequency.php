<?php

namespace App\Dto\Entity\Ai;

use App\Entity\Word;

class WordFrequency
{
    public function __construct(
        protected Word $word,
        protected int $frequency
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

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    public function setFrequency(int $frequency): void
    {
        $this->frequency = $frequency;
    }
}