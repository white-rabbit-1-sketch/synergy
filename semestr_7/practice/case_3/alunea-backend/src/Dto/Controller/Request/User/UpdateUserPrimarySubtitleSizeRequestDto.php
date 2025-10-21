<?php

namespace App\Dto\Controller\Request\User;

use App\Enum\UserSubtitleSizeEnum;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserPrimarySubtitleSizeRequestDto
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
            message: 'Primary subtitle size must be one of: {{ choices }}'
        )]
        protected string $primarySubtitleSize,
    ) {
    }

    public function getPrimarySubtitleSize(): string
    {
        return $this->primarySubtitleSize;
    }

    public function setPrimarySubtitleSize(string $primarySubtitleSize): void
    {
        $this->primarySubtitleSize = $primarySubtitleSize;
    }
}