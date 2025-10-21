<?php

namespace App\Dto\Entity\Overview;

use App\Dto\Entity\UserWordReferenceStatus;
use App\Entity\Phrase;

class ExtensionVideoPhraseOverview
{
    protected ?string $userPhraseReferenceStatus = null;
    /** @var UserWordReferenceStatus[] */
    protected array $userWordsReferencesStatuses = [];

    public function __construct(
        protected Phrase $phrase,
        protected array $phraseParts,
    )
    {
    }

    public function getPhrase(): Phrase
    {
        return $this->phrase;
    }

    public function setPhrase(Phrase $phrase): void
    {
        $this->phrase = $phrase;
    }

    public function getPhraseParts(): array
    {
        return $this->phraseParts;
    }

    public function setPhraseParts(array $phraseParts): void
    {
        $this->phraseParts = $phraseParts;
    }

    public function getUserPhraseReferenceStatus(): ?string
    {
        return $this->userPhraseReferenceStatus;
    }

    public function setUserPhraseReferenceStatus(?string $userPhraseReferenceStatus): void
    {
        $this->userPhraseReferenceStatus = $userPhraseReferenceStatus;
    }

    public function getUserWordsReferencesStatuses(): array
    {
        return $this->userWordsReferencesStatuses;
    }

    public function setUserWordsReferencesStatuses(array $userWordsReferencesStatuses): void
    {
        $this->userWordsReferencesStatuses = $userWordsReferencesStatuses;
    }
}