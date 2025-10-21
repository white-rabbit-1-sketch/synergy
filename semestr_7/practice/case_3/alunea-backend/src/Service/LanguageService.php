<?php

namespace App\Service;

use App\Entity\Language;
use App\Repository\LanguageRepository;

class LanguageService
{
    protected const DEFAULT_LANGUAGE_CODE = 'en';

    public function __construct(
        protected LanguageRepository $languageRepository,
    ) {}

    public function getDefaultLanguage(): Language
    {
        return $this->languageRepository->find(self::DEFAULT_LANGUAGE_CODE);
    }

    public function getLanguageByCode(string $code): ?Language
    {
        return $this->languageRepository->find($code);
    }

    /**
     * @return Language[]
     */
    public function getLanguages(): array
    {
        return $this->languageRepository->findAll();
    }
}