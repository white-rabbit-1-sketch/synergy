<?php

namespace App\Dto\Entity\Overview;

use App\Entity\User;
use App\Entity\UserSubscription;

class UserOverview
{
    public function __construct(
        protected User  $user,
        protected array $userLanguageReferences,
        protected int   $wordsInStudyCount,
        protected int   $phrasesInStudyCount,
        protected int   $wordsStudiedCount,
        protected int   $phrasesStudiedCount,
        protected ?UserSubscription $userSubscription,
    )
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUserLanguageReferences(): array
    {
        return $this->userLanguageReferences;
    }

    public function setUserLanguageReferences(array $userLanguageReferences): void
    {
        $this->userLanguageReferences = $userLanguageReferences;
    }

    public function getWordsInStudyCount(): int
    {
        return $this->wordsInStudyCount;
    }

    public function setWordsInStudyCount(int $wordsInStudyCount): void
    {
        $this->wordsInStudyCount = $wordsInStudyCount;
    }

    public function getPhrasesInStudyCount(): int
    {
        return $this->phrasesInStudyCount;
    }

    public function setPhrasesInStudyCount(int $phrasesInStudyCount): void
    {
        $this->phrasesInStudyCount = $phrasesInStudyCount;
    }

    public function getWordsStudiedCount(): int
    {
        return $this->wordsStudiedCount;
    }

    public function setWordsStudiedCount(int $wordsStudiedCount): void
    {
        $this->wordsStudiedCount = $wordsStudiedCount;
    }

    public function getPhrasesStudiedCount(): int
    {
        return $this->phrasesStudiedCount;
    }

    public function setPhrasesStudiedCount(int $phrasesStudiedCount): void
    {
        $this->phrasesStudiedCount = $phrasesStudiedCount;
    }

    public function getUserSubscription(): ?UserSubscription
    {
        return $this->userSubscription;
    }

    public function setUserSubscription(?UserSubscription $userSubscription): void
    {
        $this->userSubscription = $userSubscription;
    }
}