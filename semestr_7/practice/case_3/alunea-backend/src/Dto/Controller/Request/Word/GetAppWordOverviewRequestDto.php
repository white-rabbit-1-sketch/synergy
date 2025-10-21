<?php

namespace App\Dto\Controller\Request\Word;

use App\Enum\RegexpPatternEnum;
use Symfony\Component\Validator\Constraints as Assert;

class GetAppWordOverviewRequestDto
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
            minMessage: 'Word must be at least {{ limit }} characters long',
            maxMessage: 'Word cannot be longer than {{ limit }} characters',
        )]
        #[Assert\Regex([
            'pattern' => RegexpPatternEnum::TOKEN_WORD,
            'message' => 'Word is invalid',
        ])]
        protected ?string $word,
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

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(?string $word): void
    {
        $this->word = $word;
    }
}