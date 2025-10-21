<?php

namespace App\Dto\Controller\Response\Version;

use App\Dto\Controller\Response\AbstractResponseDto;

class HandleAppVersionResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected bool $isAppVersionUpdateAvailable,
        protected bool $isAppVersionSupported
    )
    {
    }

    public function isAppVersionUpdateAvailable(): bool
    {
        return $this->isAppVersionUpdateAvailable;
    }

    public function setIsAppVersionUpdateAvailable(bool $isAppVersionUpdateAvailable): void
    {
        $this->isAppVersionUpdateAvailable = $isAppVersionUpdateAvailable;
    }

    public function isAppVersionSupported(): bool
    {
        return $this->isAppVersionSupported;
    }

    public function setIsAppVersionSupported(bool $isAppVersionSupported): void
    {
        $this->isAppVersionSupported = $isAppVersionSupported;
    }
}