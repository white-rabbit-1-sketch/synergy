<?php

namespace App\Dto\Controller\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserNativeLanguageRequestDto
{
    public function __construct(
        #[Assert\Length(
            min: 2,
            max: 2,
            minMessage: 'Native language code must be at least {{ limit }} characters long',
            maxMessage: 'Native language code cannot be longer than {{ limit }} characters',
        )]
        protected ?string $nativeLanguageCode,
    ) {
    }

    public function getNativeLanguageCode(): ?string
    {
        return $this->nativeLanguageCode;
    }

    public function setNativeLanguageCode(?string $nativeLanguageCode): void
    {
        $this->nativeLanguageCode = $nativeLanguageCode;
    }
}