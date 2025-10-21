<?php

namespace App\Dto\Controller\Request\Word;

use App\Enum\RegexpPatternEnum;
use Symfony\Component\Validator\Constraints as Assert;

class MarkWordAsInStudyRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(
            min: 2,
            max: 2,
            minMessage: 'Language code must be at least {{ limit }} characters long',
            maxMessage: 'Language code cannot be longer than {{ limit }} characters',
        )]
        protected ?string $sourceLanguageCode,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Word must be at least {{ limit }} characters long',
            maxMessage: 'Word cannot be longer than {{ limit }} characters',
        )]
        #[Assert\Regex([
            'pattern' => RegexpPatternEnum::TOKEN_WORD,
            'message' => 'Word is invalid',
        ])]
        protected string $word,

        #[Assert\Choice(
            choices: ['netflix',],
            message: 'Integration must be one of: {{ choices }}'
        )]
        protected ?string $contextIntegration,

        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Phrase must be at least {{ limit }} characters long',
            maxMessage: 'Phrase cannot be longer than {{ limit }} characters',
        )]
        protected ?string $phrase,

        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Video id must be at least {{ limit }} characters long',
            maxMessage: 'Video id cannot be longer than {{ limit }} characters',
        )]
        protected ?string $contextVideoId = null,

        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Video name must be at least {{ limit }} characters long',
            maxMessage: 'Video name cannot be longer than {{ limit }} characters',
        )]
        protected ?string $contextVideoName = null,

        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Video name must be at least {{ limit }} characters long',
            maxMessage: 'Video name cannot be longer than {{ limit }} characters',
        )]
        protected ?string $contextEpisodeName = null,

        protected ?int $contextEpisodeNumber = null,

        protected ?int $contextVideoTime = null
    ) {
    }

    public function getSourceLanguageCode(): ?string
    {
        return $this->sourceLanguageCode;
    }

    public function setSourceLanguageCode(?string $sourceLanguageCode): void
    {
        $this->sourceLanguageCode = $sourceLanguageCode;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function setWord(string $word): void
    {
        $this->word = $word;
    }

    public function getPhrase(): ?string
    {
        return $this->phrase;
    }

    public function setPhrase(?string $phrase): void
    {
        $this->phrase = $phrase;
    }

    public function getContextIntegration(): ?string
    {
        return $this->contextIntegration;
    }

    public function setContextIntegration(?string $contextIntegration): void
    {
        $this->contextIntegration = $contextIntegration;
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
}