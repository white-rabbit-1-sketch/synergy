<?php

namespace App\Dto\Controller\Response\Phrase;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Dto\Entity\Overview\AppPhraseOverview;

class GetAppPhraseOverviewResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected AppPhraseOverview $appPhraseOverview,
    )
    {
    }

    public function getAppPhraseOverview(): AppPhraseOverview
    {
        return $this->appPhraseOverview;
    }

    public function setAppPhraseOverview(AppPhraseOverview $appPhraseOverview): void
    {
        $this->appPhraseOverview = $appPhraseOverview;
    }
}