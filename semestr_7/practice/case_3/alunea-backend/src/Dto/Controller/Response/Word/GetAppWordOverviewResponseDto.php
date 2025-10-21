<?php

namespace App\Dto\Controller\Response\Word;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Dto\Entity\Overview\AppWordOverview;

class GetAppWordOverviewResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected AppWordOverview $appWordOverview,
    )
    {
    }

    public function getAppWordOverview(): AppWordOverview
    {
        return $this->appWordOverview;
    }

    public function setAppWordOverview(AppWordOverview $appWordOverview): void
    {
        $this->appWordOverview = $appWordOverview;
    }
}