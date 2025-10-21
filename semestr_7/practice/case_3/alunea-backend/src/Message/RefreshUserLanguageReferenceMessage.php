<?php

namespace App\Message;

class RefreshUserLanguageReferenceMessage
{
    public function __construct(
        protected string $userId,
        protected string $languageCode
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }
}