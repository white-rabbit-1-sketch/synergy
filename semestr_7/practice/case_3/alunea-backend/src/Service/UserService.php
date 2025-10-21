<?php

namespace App\Service;

use App\Entity\Language;
use App\Entity\PurchaseProduct\SubscriptionPurchaseProduct;
use App\Entity\User;
use App\Enum\ProviderEnum;
use App\Enum\PurchaseSourceEnum;
use App\Enum\PurchaseStatusEnum;
use App\Enum\UserStatusEnum;
use App\Enum\UserSubtitleSizeEnum;
use App\Message\UserNativeLanguageUpdatedEventMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Clock\DatePoint;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected UserPasswordHasherInterface $passwordHasher,
        protected LanguageService $languageService,
        protected MessageBusInterface $messageBus,
        protected EntityManagerInterface $entityManager,
        protected UserSubscriptionService $userSubscriptionService,
        protected SubscriptionPlanService $subscriptionPlanService,
        protected PurchaseTransactionService $purchaseTransactionService,
        protected PurchaseTransactionProviderGroupService $purchaseTransactionProviderGroupService,
        protected PurchaseProviderProductService $purchaseProviderProductService
    ) {}

    /**
     * @return \Generator<User>
     */
    public function getUsers(): \Generator
    {
        return $this->userRepository->findAllGenerator();
    }

    public function createUser(
        string $email,
        string $password,
        ?string $registrationIp = null,
        ?Language $nativeLanguage = null,
    ): User {
        if (!$nativeLanguage) {
            $nativeLanguage = $this->languageService->getDefaultLanguage();
        }

        $user = $this->entityManager->wrapInTransaction(function() use ($email, $password, $registrationIp, $nativeLanguage) {
            $user = new User();
            $user->setStatus(UserStatusEnum::ACTIVE);
            $user->setEmail($email);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setNativeLanguage($nativeLanguage);
            $user->setShowSecondarySubtitles(true);
            $user->setHighlightRecommendedWords(true);
            $user->setHighlightWordsInStudy(true);
            $user->setPrimarySubtitleSize(UserSubtitleSizeEnum::MEDIUM);
            $user->setSecondarySubtitleSize(UserSubtitleSizeEnum::MEDIUM);
            $user->setRegistrationIp($registrationIp);
            $user->setCreateTime(new DatePoint());

            $this->userRepository->save($user);

            return $user;
        });

        return $user;
    }

    public function getUserById(string $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    public function getUserByGoogleId(string $googleId): ?User
    {
        return $this->userRepository->findOneBy(['googleId' => $googleId]);
    }

    public function getUserByAppleId(string $appleId): ?User
    {
        return $this->userRepository->findOneBy(['appleId' => $appleId]);
    }

    public function getUserByFacebookId(string $facebookId): ?User
    {
        return $this->userRepository->findOneBy(['facebookId' => $facebookId]);
    }

    public function getUserByDiscordId(string $discordId): ?User
    {
        return $this->userRepository->findOneBy(['discordId' => $discordId]);
    }

    public function getUserByGithubId(string $githubId): ?User
    {
        return $this->userRepository->findOneBy(['githubId' => $githubId]);
    }

    public function getUserByYandexId(string $yandexId): ?User
    {
        return $this->userRepository->findOneBy(['yandexId' => $yandexId]);
    }

    public function saveUser(User $user): void
    {
        $this->userRepository->save($user);
    }

    public function updateUserNativeLanguage(User $user, Language $nativeLanguage): void
    {
        if ($user->getNativeLanguage()->getCode() != $nativeLanguage->getCode()) {
            $user->setNativeLanguage($nativeLanguage);
            $this->saveUser($user);

            $this->messageBus->dispatch(new UserNativeLanguageUpdatedEventMessage(
                $user->getId(),
                $nativeLanguage->getCode()
            ));
        }
    }
}