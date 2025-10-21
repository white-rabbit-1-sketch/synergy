<?php

namespace App\Dto\Controller\Response\Word;

use App\Dto\Controller\Response\AbstractResponseDto;
use App\Dto\Entity\Overview\ExtensionVideoWordOverview;

class EnsureExtensionVideoWordOverviewByValuesResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected ExtensionVideoWordOverview $extensionVideoWordOverview,
    )
    {
    }

    public function getExtensionVideoWordOverview(): ExtensionVideoWordOverview
    {
        return $this->extensionVideoWordOverview;
    }

    public function setExtensionVideoWordOverview(ExtensionVideoWordOverview $extensionVideoWordOverview): void
    {
        $this->extensionVideoWordOverview = $extensionVideoWordOverview;
    }
}