<?php

namespace App\Service;

use App\Repository\VersionRepository;
use Composer\Semver\Comparator;

class VersionService
{
    protected const TYPE_APP_ACTUAL = 'app-actual';
    protected const TYPE_APP_MIN_SUPPORTED = 'app-min-supported';

    public function __construct(
        protected VersionRepository $versionRepository,
    ) {}

    public function isAppVersionUpdateAvailable(string $version): bool
    {
        $appActualVersion = $this->versionRepository->find(self::TYPE_APP_ACTUAL)->getVersion();

        return Comparator::lessThan($version, $appActualVersion);
    }

    public function isAppVersionSupported(string $version): string
    {
        $appMinSupportedVersion = $this->versionRepository->find(self::TYPE_APP_MIN_SUPPORTED)->getVersion();

        return Comparator::greaterThanOrEqualTo($version, $appMinSupportedVersion);
    }
}