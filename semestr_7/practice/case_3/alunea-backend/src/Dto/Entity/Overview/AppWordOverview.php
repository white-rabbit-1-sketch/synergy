<?php

namespace App\Dto\Entity\Overview;

use App\Entity\Word;
use App\Entity\WordImage;
use App\Entity\WordPhraseMeaning;
use App\Entity\WordPhraseTranslation;
use App\Entity\WordSpeech;
use App\Entity\WordTranslation;

class AppWordOverview
{
    /** @var WordTranslation[] */
    protected array $translations = [];
    /** @var AppNestedPhraseOverview[] */
    protected array $examplePhrasesOverviews = [];
    /** @var AppNestedWordOverview[] */
    protected array $synonyms = [];
    /** @var AppNestedWordOverview[] */
    protected array $antonyms = [];
    /** @var AppNestedPhraseOverview[] */
    protected array $collocations = [];
    protected ?WordPhraseTranslation $contextTranslation = null;
    protected ?WordPhraseMeaning $contextMeaning = null;
    protected bool $isInterested = false;
    protected ?string $contextVideoId = null;
    protected ?string $contextVideoName = null;
    protected ?string $contextEpisodeName = null;
    protected ?int $contextEpisodeNumber = null;
    protected ?int $contextVideoTime = null;
    protected ?WordImage $image = null;
    protected ?WordSpeech $speech = null;
    protected ?AppNestedPhraseOverview $contextPhraseOverview = null;

    /**
     * @param Word $word
     * @param AppNestedPhraseOverview $contextPhraseOverview
     * @param string $userWordReferenceStatus
     */
    public function __construct(
        protected Word                    $word,
        protected string                  $userWordReferenceStatus,
        protected string                  $processingStatus,
        protected string                  $contextIntegration
    ) {
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }

    public function getExamplePhrasesOverviews(): array
    {
        return $this->examplePhrasesOverviews;
    }

    public function setExamplePhrasesOverviews(array $examplePhrasesOverviews): void
    {
        $this->examplePhrasesOverviews = $examplePhrasesOverviews;
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

    public function getCollocations(): array
    {
        return $this->collocations;
    }

    public function setCollocations(array $collocations): void
    {
        $this->collocations = $collocations;
    }

    public function getContextTranslation(): ?WordPhraseTranslation
    {
        return $this->contextTranslation;
    }

    public function setContextTranslation(?WordPhraseTranslation $contextTranslation): void
    {
        $this->contextTranslation = $contextTranslation;
    }

    public function getContextMeaning(): ?WordPhraseMeaning
    {
        return $this->contextMeaning;
    }

    public function setContextMeaning(?WordPhraseMeaning $contextMeaning): void
    {
        $this->contextMeaning = $contextMeaning;
    }

    public function isInterested(): bool
    {
        return $this->isInterested;
    }

    public function setIsInterested(bool $isInterested): void
    {
        $this->isInterested = $isInterested;
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

    public function getImage(): ?WordImage
    {
        return $this->image;
    }

    public function setImage(?WordImage $image): void
    {
        $this->image = $image;
    }

    public function getSpeech(): ?WordSpeech
    {
        return $this->speech;
    }

    public function setSpeech(?WordSpeech $speech): void
    {
        $this->speech = $speech;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function getContextPhraseOverview(): ?AppNestedPhraseOverview
    {
        return $this->contextPhraseOverview;
    }

    public function setContextPhraseOverview(?AppNestedPhraseOverview $contextPhraseOverview): void
    {
        $this->contextPhraseOverview = $contextPhraseOverview;
    }

    public function getUserWordReferenceStatus(): string
    {
        return $this->userWordReferenceStatus;
    }

    public function setUserWordReferenceStatus(string $userWordReferenceStatus): void
    {
        $this->userWordReferenceStatus = $userWordReferenceStatus;
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