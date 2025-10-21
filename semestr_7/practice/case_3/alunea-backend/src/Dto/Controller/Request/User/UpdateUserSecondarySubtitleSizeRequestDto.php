<?php

namespace App\Dto\Controller\Request\User;

use App\Enum\UserSubtitleSizeEnum;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserSecondarySubtitleSizeRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Choice(
            choices: [
                UserSubtitleSizeEnum::EXTRA_SMALL,
                UserSubtitleSizeEnum::SMALL,
                UserSubtitleSizeEnum::MEDIUM,
                UserSubtitleSizeEnum::LARGE,
                UserSubtitleSizeEnum::EXTRA_LARGE,
            ],
            message: 'Secondary subtitle size must be one of: {{ choices }}'
        )]
        protected string $secondarySubtitleSize,
    ) {
    }

    public function getSecondarySubtitleSize(): string
    {
        return $this->secondarySubtitleSize;
    }

    public function setSecondarySubtitleSize(string $secondarySubtitleSize): void
    {
        $this->secondarySubtitleSize = $secondarySubtitleSize;
    }
}