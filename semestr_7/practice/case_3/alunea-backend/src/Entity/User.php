<?php

namespace App\Entity;

use App\Enum\UserRoleEnum;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected UuidInterface $id;

    #[ORM\Column]
    protected ?string $status = null;

    #[ORM\Column]
    protected ?string $email = null;

    #[ORM\Column]
    protected ?string $password = null;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: "native_language_code", referencedColumnName: "code")]
    protected ?Language $nativeLanguage = null;

    #[ORM\Column]
    protected bool $showSecondarySubtitles = true;

    #[ORM\Column]
    protected bool $highlightRecommendedWords = true;

    #[ORM\Column]
    protected bool $highlightWordsInStudy = true;

    #[ORM\Column]
    protected ?string $primarySubtitleSize = null;

    #[ORM\Column]
    protected ?string $secondarySubtitleSize = null;

    #[ORM\Column]
    protected ?string $googleId = null;

    #[ORM\Column]
    protected ?string $appleId = null;

    #[ORM\Column]
    protected ?string $facebookId = null;

    #[ORM\Column]
    protected ?string $discordId = null;

    #[ORM\Column]
    protected ?string $githubId = null;

    #[ORM\Column]
    protected ?string $yandexId = null;

    #[ORM\Column]
    protected ?string $registrationIp = null;

    #[ORM\Column]
    protected bool $optIn = false;

    #[ORM\Column]
    protected ?\DateTimeImmutable $createTime = null;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getNativeLanguage(): ?Language
    {
        return $this->nativeLanguage;
    }

    public function setNativeLanguage(?Language $nativeLanguage): void
    {
        $this->nativeLanguage = $nativeLanguage;
    }

    public function getShowSecondarySubtitles(): bool
    {
        return $this->showSecondarySubtitles;
    }

    public function setShowSecondarySubtitles(bool $showSecondarySubtitles): void
    {
        $this->showSecondarySubtitles = $showSecondarySubtitles;
    }

    public function getHighlightRecommendedWords(): bool
    {
        return $this->highlightRecommendedWords;
    }

    public function setHighlightRecommendedWords(bool $highlightRecommendedWords): void
    {
        $this->highlightRecommendedWords = $highlightRecommendedWords;
    }

    public function getHighlightWordsInStudy(): bool
    {
        return $this->highlightWordsInStudy;
    }

    public function setHighlightWordsInStudy(bool $highlightWordsInStudy): void
    {
        $this->highlightWordsInStudy = $highlightWordsInStudy;
    }

    public function getPrimarySubtitleSize(): ?string
    {
        return $this->primarySubtitleSize;
    }

    public function setPrimarySubtitleSize(?string $primarySubtitleSize): void
    {
        $this->primarySubtitleSize = $primarySubtitleSize;
    }

    public function getSecondarySubtitleSize(): ?string
    {
        return $this->secondarySubtitleSize;
    }

    public function setSecondarySubtitleSize(?string $secondarySubtitleSize): void
    {
        $this->secondarySubtitleSize = $secondarySubtitleSize;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): void
    {
        $this->googleId = $googleId;
    }

    public function getAppleId(): ?string
    {
        return $this->appleId;
    }

    public function setAppleId(?string $appleId): void
    {
        $this->appleId = $appleId;
    }

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): void
    {
        $this->facebookId = $facebookId;
    }

    public function getDiscordId(): ?string
    {
        return $this->discordId;
    }

    public function setDiscordId(?string $discordId): void
    {
        $this->discordId = $discordId;
    }

    public function getGithubId(): ?string
    {
        return $this->githubId;
    }

    public function setGithubId(?string $githubId): void
    {
        $this->githubId = $githubId;
    }

    public function getYandexId(): ?string
    {
        return $this->yandexId;
    }

    public function setYandexId(?string $yandexId): void
    {
        $this->yandexId = $yandexId;
    }

    public function getRegistrationIp(): ?string
    {
        return $this->registrationIp;
    }

    public function setRegistrationIp(?string $registrationIp): void
    {
        $this->registrationIp = $registrationIp;
    }

    public function getOptIn(): ?bool
    {
        return $this->optIn;
    }

    public function setOptIn(?bool $optIn): void
    {
        $this->optIn = $optIn;
    }

    public function getCreateTime(): ?\DateTimeImmutable
    {
        return $this->createTime;
    }

    public function setCreateTime(?\DateTimeImmutable $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return [UserRoleEnum::ROLE_USER];
    }

    public function eraseCredentials(): void
    {

    }
}
