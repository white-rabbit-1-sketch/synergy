<?php

namespace App\Dto\Controller\Request\Word;

use App\Enum\RegexpPatternEnum;
use Symfony\Component\Validator\Constraints as Assert;

class EnsureExtensionVideoWordOverviewByValuesRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(
            min: 2,
            max: 2,
            minMessage: 'Source language code must be at least {{ limit }} characters long',
            maxMessage: 'Source language code cannot be longer than {{ limit }} characters',
        )]
        protected ?string $sourceLanguageCode,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 2,
            max: 2,
            minMessage: 'Target language code must be at least {{ limit }} characters long',
            maxMessage: 'Target language code cannot be longer than {{ limit }} characters',
        )]
        protected ?string $targetLanguageCode,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Source phrase must be at least {{ limit }} characters long',
            maxMessage: 'Source phrase cannot be longer than {{ limit }} characters',
        )]
        protected string $contextSourcePhrase,

        #[Assert\Length(
            min: 1,
            max: 255,
            minMessage: 'Target phrase must be at least {{ limit }} characters long',
            maxMessage: 'Target phrase cannot be longer than {{ limit }} characters',
        )]
        protected ?string $contextTargetPhrase,

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

    public function getTargetLanguageCode(): ?string
    {
        return $this->targetLanguageCode;
    }

    public function setTargetLanguageCode(?string $targetLanguageCode): void
    {
        $this->targetLanguageCode = $targetLanguageCode;
    }

    public function getContextSourcePhrase(): string
    {
        return $this->contextSourcePhrase;
    }

    public function setContextSourcePhrase(string $contextSourcePhrase): void
    {
        $this->contextSourcePhrase = $contextSourcePhrase;
    }

    public function getContextTargetPhrase(): ?string
    {
        return $this->contextTargetPhrase;
    }

    public function setContextTargetPhrase(?string $contextTargetPhrase): void
    {
        $this->contextTargetPhrase = $contextTargetPhrase;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function setWord(string $word): void
    {
        $this->word = $word;
    }
}