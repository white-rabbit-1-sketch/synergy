<?php

namespace App\Dto\Controller\Response\Translation;

use App\Dto\Controller\Response\AbstractResponseDto;

class TranslatePhrasesResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected array $translations
    )
    {
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }
}