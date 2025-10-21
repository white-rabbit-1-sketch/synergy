<?php

namespace App\Tests\Factory;

use App\Entity\Provider;
use App\Enum\ProviderEnum;
use App\Repository\ProviderRepository;
use App\Service\StringService;

class ProviderFactory
{
    public function __construct(
        protected ProviderRepository $providerRepository,
        protected StringService $stringService
    )
    {
    }

    public function createGoogleProviderIfNotExists(): Provider
    {
        $provider = $this->providerRepository->find(ProviderEnum::GOOGLE);

        if (!$provider) {
            $provider = new Provider();
            $provider->setCode(ProviderEnum::GOOGLE);
            $provider->setTitle(ProviderEnum::GOOGLE);

            $this->providerRepository->save($provider);
        }

        return $provider;
    }

    public function createAppleProviderIfNotExists(): Provider
    {
        $provider = $this->providerRepository->find(ProviderEnum::APPLE);

        if (!$provider) {
            $provider = new Provider();
            $provider->setCode(ProviderEnum::APPLE);
            $provider->setTitle(ProviderEnum::APPLE);

            $this->providerRepository->save($provider);
        }

        return $provider;
    }
}