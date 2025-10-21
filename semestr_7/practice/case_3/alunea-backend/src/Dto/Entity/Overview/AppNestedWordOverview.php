<?php

namespace App\Dto\Entity\Overview;

use App\Entity\Word;
use App\Entity\WordTranslation;

class AppNestedWordOverview
{
    /** @var WordTranslation[] */
    protected array $translations = [];
    protected ?string $userWordReferenceStatus = null;

    /**
     * @param Word $word
     */
    public function __construct(
        protected Word $word,
    ) {
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function getUserWordReferenceStatus(): ?string
    {
        return $this->userWordReferenceStatus;
    }

    public function setUserWordReferenceStatus(?string $userWordReferenceStatus): void
    {
        $this->userWordReferenceStatus = $userWordReferenceStatus;
    }
}