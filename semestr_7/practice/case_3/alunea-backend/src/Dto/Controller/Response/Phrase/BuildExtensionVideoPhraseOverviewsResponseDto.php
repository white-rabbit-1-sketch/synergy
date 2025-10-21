<?php

namespace App\Dto\Controller\Response\Phrase;

use App\Dto\Controller\Response\AbstractResponseDto;

class BuildExtensionVideoPhraseOverviewsResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected array $extensionVideoPhraseOverviews,
    )
    {
    }

    public function getExtensionVideoPhraseOverviews(): array
    {
        return $this->extensionVideoPhraseOverviews;
    }

    public function setExtensionVideoPhraseOverviews(array $extensionVideoPhraseOverviews): void
    {
        $this->extensionVideoPhraseOverviews = $extensionVideoPhraseOverviews;
    }
}