<?php

namespace App\Dto\Controller\Response\Social;

use App\Dto\Controller\Response\AbstractResponseDto;

class CheckNativeAppleResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected string $token
    )
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}