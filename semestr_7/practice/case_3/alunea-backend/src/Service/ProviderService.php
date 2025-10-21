<?php

namespace App\Service;

use App\Entity\Provider;
use App\Repository\ProviderRepository;

class ProviderService
{
    public function __construct(
        protected ProviderRepository $providerRepository,
    ) {}

    public function getProviderByCode(string $code): ?Provider
    {
        return $this->providerRepository->find($code);
    }
}