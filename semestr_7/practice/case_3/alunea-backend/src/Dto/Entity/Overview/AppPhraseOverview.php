<?php

namespace App\Dto\Entity\Overview;

use App\Dto\Entity\UserWordReferenceStatus;
use App\Entity\Phrase;
use App\Entity\PhraseSpeech;
use App\Entity\PhraseTranslation;

class AppPhraseOverview
{
    protected ?PhraseTranslation $translation = null;
    /** @var UserWordReferenceStatus[] */
    protected array $userWordsReferencesStatuses = [];
    /** @var AppNestedPhraseOverview[] */
    protected array $synonyms = [];
    /** @var AppNestedPhraseOverview[] */
    protected array $antonyms = [];
    protected ?string $contextVideoId = null;
    protected ?string $contextVideoName = null;
    protected ?string $contextEpisodeName = null;
    protected ?int $contextEpisodeNumber = null;
    protected ?int $contextVideoTime = null;
    protected ?PhraseSpeech $speech = null;

    public function __construct(
        protected Phrase $phrase,
        protected array $phraseParts,
        protected string $userPhraseReferenceStatus,
        protected string $processingStatus,
        protected string $contextIntegration
    )
    {
    }

    public function getTranslation(): ?PhraseTranslation
    {
        return $this->translation;
    }

    public function setTranslation(?PhraseTranslation $translation): void
    {
        $this->translation = $translation;
    }

    public function getUserWordsReferencesStatuses(): array
    {
        return $this->userWordsReferencesStatuses;
    }

    public function setUserWordsReferencesStatuses(array $userWordsReferencesStatuses): void
    {
        $this->userWordsReferencesStatuses = $userWordsReferencesStatuses;
    }

    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    public function setSynonyms(array $synonyms): void
    {
        $this->synonyms = $synonyms;
    }

    public function getAntonyms(): array
    {
        return $this->antonyms;
    }

    public function setAntonyms(array $antonyms): void
    {
        $this->antonyms = $antonyms;
    }

    public function getContextVideoId(): ?string
    {
        return $this->contextVideoId;
    }

    public function setContextVideoId(?string $contextVideoId): void
    {
        $this->contextVideoId = $contextVideoId;
    }

    public function getContextVideoName(): ?string
    {
        return $this->contextVideoName;
    }

    public function setContextVideoName(?string $contextVideoName): void
    {
        $this->contextVideoName = $contextVideoName;
    }

    public function getContextEpisodeName(): ?string
    {
        return $this->contextEpisodeName;
    }

    public function setContextEpisodeName(?string $contextEpisodeName): void
    {
        $this->contextEpisodeName = $contextEpisodeName;
    }

    public function getContextEpisodeNumber(): ?int
    {
        return $this->contextEpisodeNumber;
    }

    public function setContextEpisodeNumber(?int $contextEpisodeNumber): void
    {
        $this->contextEpisodeNumber = $contextEpisodeNumber;
    }

    public function getContextVideoTime(): ?int
    {
        return $this->contextVideoTime;
    }

    public function setContextVideoTime(?int $contextVideoTime): void
    {
        $this->contextVideoTime = $contextVideoTime;
    }

    public function getSpeech(): ?PhraseSpeech
    {
        return $this->speech;
    }

    public function setSpeech(?PhraseSpeech $speech): void
    {
        $this->speech = $speech;
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

    public function getUserPhraseReferenceStatus(): string
    {
        return $this->userPhraseReferenceStatus;
    }

    public function setUserPhraseReferenceStatus(string $userPhraseReferenceStatus): void
    {
        $this->userPhraseReferenceStatus = $userPhraseReferenceStatus;
    }

    public function getContextIntegration(): string
    {
        return $this->contextIntegration;
    }

    public function setContextIntegration(string $contextIntegration): void
    {
        $this->contextIntegration = $contextIntegration;
    }

    public function getProcessingStatus(): string
    {
        return $this->processingStatus;
    }

    public function setProcessingStatus(string $processingStatus): void
    {
        $this->processingStatus = $processingStatus;
    }
}