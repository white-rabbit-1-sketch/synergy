<?php

namespace App\Dto\Controller\Response\User;

use App\Dto\Controller\Response\AbstractResponseDto;

class IsUserEmailAvailableResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected bool $isAvailable
    )
    {
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }
}