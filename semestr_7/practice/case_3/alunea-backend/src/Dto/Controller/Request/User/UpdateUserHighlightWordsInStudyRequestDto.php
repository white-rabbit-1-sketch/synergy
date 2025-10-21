<?php

namespace App\Dto\Controller\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserHighlightWordsInStudyRequestDto
{
    public function __construct(
        #[Assert\Type('bool')]
        protected bool $highlightWordsInStudy,
    ) {
    }

    public function getHighlightWordsInStudy(): bool
    {
        return $this->highlightWordsInStudy;
    }

    public function setHighlightWordsInStudy(bool $highlightWordsInStudy): void
    {
        $this->highlightWordsInStudy = $highlightWordsInStudy;
    }
}