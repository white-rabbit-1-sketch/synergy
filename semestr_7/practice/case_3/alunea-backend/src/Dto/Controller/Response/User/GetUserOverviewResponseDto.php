<?php

namespace App\Dto\Controller\Response\User;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Dto\Entity\Overview\UserOverview;

class GetUserOverviewResponseDto extends AbstractResponseDto
{

    public function __construct(
        protected UserOverview $userOverview
    )
    {
    }

    public function getUserOverview(): UserOverview
    {
        return $this->userOverview;
    }

    public function setUserOverview(UserOverview $userOverview): void
    {
        $this->userOverview = $userOverview;
    }
}