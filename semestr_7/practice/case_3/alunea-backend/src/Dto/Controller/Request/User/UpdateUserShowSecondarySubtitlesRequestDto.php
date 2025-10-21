<?php

namespace App\Dto\Controller\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserShowSecondarySubtitlesRequestDto
{
    public function __construct(
        #[Assert\Type('bool')]
        protected bool $showSecondarySubtitles,
    ) {
    }

    public function getShowSecondarySubtitles(): bool
    {
        return $this->showSecondarySubtitles;
    }

    public function setShowSecondarySubtitles(bool $showSecondarySubtitles): void
    {
        $this->showSecondarySubtitles = $showSecondarySubtitles;
    }
}