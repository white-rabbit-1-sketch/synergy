<?php

namespace App\Dto\Controller\Request\Phrase;

use App\Entity\UserPhraseReference;
use App\Enum\Sort\UserPhraseOverviewSortEnum;
use Symfony\Component\Validator\Constraints as Assert;

class GetAppPhraseOverviewRequestDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Source language code should be specified')]
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
            minMessage: 'Phrase must be at least {{ limit }} characters long',
            maxMessage: 'Phrase cannot be longer than {{ limit }} characters',
        )]
        protected string $phrase,
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

    public function getPhrase(): string
    {
        return $this->phrase;
    }

    public function setPhrase(string $phrase): void
    {
        $this->phrase = $phrase;
    }
}