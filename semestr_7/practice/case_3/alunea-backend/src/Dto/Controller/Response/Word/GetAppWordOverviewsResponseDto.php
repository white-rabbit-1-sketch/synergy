<?php

namespace App\Dto\Controller\Response\Word;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Dto\Entity\Overview\AppWordOverview;

class GetAppWordOverviewsResponseDto extends AbstractResponseDto
{
    /**
     * @param AppWordOverview[] $appWordOverviews
     */
    public function __construct(
        protected array $appWordOverviews,
    )
    {
    }

    public function getAppWordOverviews(): array
    {
        return $this->appWordOverviews;
    }

    public function setAppWordOverviews(array $appWordOverviews): void
    {
        $this->appWordOverviews = $appWordOverviews;
    }
}