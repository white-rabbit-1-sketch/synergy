<?php

namespace App\Dto\Controller\Response\Security;

use App\Dto\Controller\Response\AbstractResponseDto;

class CreateUserAuthTokenResponseDto extends AbstractResponseDto
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