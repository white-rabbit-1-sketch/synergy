<?php

namespace App\Message;

class EnsureAppWordOverviewMessage
{
    public function __construct(
        protected string $userWordReferenceId,
        protected string $targetLanguageCode,
    ) {
    }

    public function getUserWordReferenceId(): string
    {
        return $this->userWordReferenceId;
    }

    public function setUserWordReferenceId(string $userWordReferenceId): void
    {
        $this->userWordReferenceId = $userWordReferenceId;
    }

    public function getTargetLanguageCode(): string
    {
        return $this->targetLanguageCode;
    }

    public function setTargetLanguageCode(string $targetLanguageCode): void
    {
        $this->targetLanguageCode = $targetLanguageCode;
    }
}