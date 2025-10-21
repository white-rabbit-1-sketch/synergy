<?php

namespace App\Dto\Entity\Ai;

class WordExamplePhrases
{
    /** @var string[] */
    protected array $examples;

    public function __construct(array $examples)
    {
        $this->examples = $examples;
    }

    public function getExamples(): array
    {
        return $this->examples;
    }

    public function setExamples(array $examples): void
    {
        $this->examples = $examples;
    }
}