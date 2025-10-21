<?php

namespace App\Message;

class EnsureAppPhraseOverviewMessage
{
    public function __construct(
        protected string $userPhraseReferenceId,
        protected string $targetLanguageCode,
    ) {
    }

    public function getUserPhraseReferenceId(): string
    {
        return $this->userPhraseReferenceId;
    }

    public function setUserPhraseReferenceId(string $userPhraseReferenceId): void
    {
        $this->userPhraseReferenceId = $userPhraseReferenceId;
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