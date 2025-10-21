<?php

namespace App\Dto\Entity\Ai;

class WordSynonyms
{
    /** @var string[] */
    protected array $synonyms;

    public function __construct(array $synonyms)
    {
        $this->synonyms = $synonyms;
    }

    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    public function setSynonyms(array $synonyms): void
    {
        $this->synonyms = $synonyms;
    }
}