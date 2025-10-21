<?php

namespace App\Dto\Controller\Request\Phrase;

use Symfony\Component\Validator\Constraints as Assert;

class BuildExtensionVideoPhraseOverviewsByValuesRequestDto
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

        #[Assert\Count(
            max: 20,
            maxMessage: 'You cannot specify more than {{ limit }} phrases',
        )]
        #[Assert\All([
            new Assert\NotBlank(),
            new Assert\Length(
                min: 1,
                max: 255,
                minMessage: 'Phrase must be at least {{ limit }} characters long',
                maxMessage: 'Phrase cannot be longer than {{ limit }} characters',
            ),
        ])]
        protected array $phrases = []
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

    public function getPhrases(): array
    {
        return $this->phrases;
    }

    public function setPhrases(array $phrases): void
    {
        $this->phrases = $phrases;
    }
}