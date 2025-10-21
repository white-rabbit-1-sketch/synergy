<?php

namespace App\Dto\Entity\Ai;

class WordCollocations
{
    /** @var string[] */
    protected array $collocations;

    public function __construct(array $collocations)
    {
        $this->collocations = $collocations;
    }

    public function getCollocations(): array
    {
        return $this->collocations;
    }

    public function setCollocations(array $collocations): void
    {
        $this->collocations = $collocations;
    }
}