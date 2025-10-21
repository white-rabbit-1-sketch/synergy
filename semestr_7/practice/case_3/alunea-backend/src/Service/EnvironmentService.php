<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class EnvironmentService
{
    protected const ENV_PROD = 'prod';

    public function __construct(
        protected KernelInterface $kernel,
    ) {}

    public function isProduction(): bool
    {
        return $this->kernel->getEnvironment() === self::ENV_PROD;
    }
}