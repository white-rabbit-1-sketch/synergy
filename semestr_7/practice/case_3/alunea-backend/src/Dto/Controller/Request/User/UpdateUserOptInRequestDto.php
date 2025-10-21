<?php

namespace App\Dto\Controller\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserOptInRequestDto
{
    public function __construct(
        #[Assert\Type('bool')]
        protected bool $optIn,
    ) {
    }

    public function getOptIn(): bool
    {
        return $this->optIn;
    }

    public function setOptIn(bool $optIn): void
    {
        $this->optIn = $optIn;
    }
}