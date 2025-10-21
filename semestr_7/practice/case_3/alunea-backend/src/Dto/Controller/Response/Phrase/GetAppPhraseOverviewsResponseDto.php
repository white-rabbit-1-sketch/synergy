<?php

namespace App\Dto\Controller\Response\Phrase;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Dto\Entity\Overview\AppPhraseOverview;

class GetAppPhraseOverviewsResponseDto extends AbstractResponseDto
{
    /**
     * @param AppPhraseOverview[] $appPhraseOverviews
     */
    public function __construct(
        protected array $appPhraseOverviews,
    )
    {
    }

    public function getAppPhraseOverviews(): array
    {
        return $this->appPhraseOverviews;
    }

    public function setAppPhraseOverviews(array $appPhraseOverviews): void
    {
        $this->appPhraseOverviews = $appPhraseOverviews;
    }
}