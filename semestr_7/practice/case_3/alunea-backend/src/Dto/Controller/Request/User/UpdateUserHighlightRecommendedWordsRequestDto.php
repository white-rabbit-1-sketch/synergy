<?php

namespace App\Dto\Controller\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserHighlightRecommendedWordsRequestDto
{
    public function __construct(
        #[Assert\Type('bool')]
        protected bool $highlightRecommendedWords,
    ) {
    }

    public function getHighlightRecommendedWords(): bool
    {
        return $this->highlightRecommendedWords;
    }

    public function setHighlightRecommendedWords(bool $highlightRecommendedWords): void
    {
        $this->highlightRecommendedWords = $highlightRecommendedWords;
    }
}