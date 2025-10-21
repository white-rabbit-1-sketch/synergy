<?php

namespace App\Dto\Controller\Request\Word;

use App\Enum\RegexpPatternEnum;
use Symfony\Component\Validator\Constraints as Assert;

class MarkWordAsStudiedRequestDto
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
        protected string  $word,
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
}