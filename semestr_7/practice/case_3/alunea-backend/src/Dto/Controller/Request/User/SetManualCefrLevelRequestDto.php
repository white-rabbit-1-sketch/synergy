<?php

namespace App\Dto\Controller\Request\User;

use App\Enum\CefrLevelEnum;
use Symfony\Component\Validator\Constraints as Assert;

class SetManualCefrLevelRequestDto
{
    public function __construct(
        #[Assert\Choice(
            choices: CefrLevelEnum::CEFR_LEVELS,
            message: 'Manual CEFR level must be one of: {{ choices }}'
        )]
        protected ?string $manualCefrLevel,
    ) {
    }

    public function getManualCefrLevel(): ?string
    {
        return $this->manualCefrLevel;
    }

    public function setManualCefrLevel(?string $manualCefrLevel): void
    {
        $this->manualCefrLevel = $manualCefrLevel;
    }
}