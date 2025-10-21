<?php

namespace App\Dto\Entity;

use App\Entity\Word;

class WordVariant extends SymbolSequence
{
    public const TYPE = 'word-variant';

    public function __construct(
        protected Word $word,
        protected string $value
    ) {
        parent::__construct($this->value);
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }
}