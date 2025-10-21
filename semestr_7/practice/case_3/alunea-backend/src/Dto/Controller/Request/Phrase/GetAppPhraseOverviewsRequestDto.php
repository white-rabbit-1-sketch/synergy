<?php

namespace App\Dto\Controller\Request\Phrase;

use App\Entity\UserPhraseReference;
use App\Enum\Sort\UserPhraseOverviewSortEnum;
use Symfony\Component\Validator\Constraints as Assert;

class GetAppPhraseOverviewsRequestDto
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

        #[Assert\NotBlank(message: 'User word reference status should be specified')]
        #[Assert\Choice(
            choices: [UserPhraseReference::STATUS_IN_STUDY, UserPhraseReference::STATUS_STUDIED],
            message: 'User word reference status must be one of: {{ choices }}'
        )]
        protected ?string $userPhraseReferenceStatus,

        #[Assert\NotBlank(message: 'Limit should be specified')]
        #[Assert\Positive(message: 'Limit should be positive integer value')]
        #[Assert\Range(
            notInRangeMessage: 'Limit must be between {{ min }} and {{ max }}',
            min: 1,
            max: 100,
        )]
        protected ?int $limit,

        #[Assert\Type(type: 'integer', message: 'Offset must be an integer.')]
        #[Assert\GreaterThanOrEqual(value: 0, message: 'Offset must be greater than or equal to 0.')]
        protected int $offset = 0,

        #[Assert\Choice(
            choices: [
                UserPhraseOverviewSortEnum::NEWEST,
                UserPhraseOverviewSortEnum::OLDEST,
                UserPhraseOverviewSortEnum::ALPHABETICAL,
                UserPhraseOverviewSortEnum::ALPHABETICAL_REVERSED,
                UserPhraseOverviewSortEnum::USAGE_FREQUENCY,
                UserPhraseOverviewSortEnum::USAGE_FREQUENCY_REVERSED,
                UserPhraseOverviewSortEnum::CEFR_LEVEL,
                UserPhraseOverviewSortEnum::CEFR_LEVEL_REVERSED,
            ],
            message: 'Sort must be one of: {{ choices }}'
        )]
        protected ?string $sort = null,

        #[Assert\Length(
            min: 0,
            max: 255,
            minMessage: 'Query must be at least {{ limit }} characters long',
            maxMessage: 'Query cannot be longer than {{ limit }} characters',
        )]
        protected ?string $query = null,
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

    public function getUserPhraseReferenceStatus(): ?string
    {
        return $this->userPhraseReferenceStatus;
    }

    public function setUserPhraseReferenceStatus(?string $userPhraseReferenceStatus): void
    {
        $this->userPhraseReferenceStatus = $userPhraseReferenceStatus;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getSort(): ?string
    {
        return $this->sort;
    }

    public function setSort(?string $sort): void
    {
        $this->sort = $sort;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }
}