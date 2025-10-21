<?php

namespace App\Dto\Controller\Request\Translation;

use Symfony\Component\Validator\Constraints as Assert;

class TranslatePhrasesRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(
            min: 2,
            max: 2,
            minMessage: 'Source language code must be at least {{ limit }} characters long',
            maxMessage: 'Source language code cannot be longer than {{ limit }} characters',
        )]
        protected string $sourceLanguageCode,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 2,
            max: 2,
            minMessage: 'Target language code must be at least {{ limit }} characters long',
            maxMessage: 'Target language code cannot be longer than {{ limit }} characters',
        )]
        protected string $targetLanguageCode,

        #[Assert\NotBlank]
        #[Assert\Count(
            max: 10,
            maxMessage: 'A maximum of {{ limit }} source values is allowed',
        )]
        #[Assert\All([
            new Assert\NotBlank(),
            new Assert\Length(
                min: 1,
                max: 255,
                minMessage: 'Value must be at least {{ limit }} characters long',
                maxMessage: 'Value cannot be longer than {{ limit }} characters',
            )
        ])]
        protected array $phrases,
    ) {
    }

    public function getSourceLanguageCode(): string
    {
        return $this->sourceLanguageCode;
    }

    public function setSourceLanguageCode(string $sourceLanguageCode): void
    {
        $this->sourceLanguageCode = $sourceLanguageCode;
    }

    public function getTargetLanguageCode(): string
    {
        return $this->targetLanguageCode;
    }

    public function setTargetLanguageCode(string $targetLanguageCode): void
    {
        $this->targetLanguageCode = $targetLanguageCode;
    }

    public function getPhrases(): array
    {
        return $this->phrases;
    }

    public function setPhrases(array $phrases): void
    {
        $this->phrases = $phrases;
    }
}