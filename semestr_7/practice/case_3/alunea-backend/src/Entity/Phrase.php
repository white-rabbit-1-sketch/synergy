<?php

namespace App\Entity;

use App\Dto\Entity\SymbolSequence;
use App\Repository\PhraseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: PhraseRepository::class)]
class Phrase
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    protected UuidInterface $id;

    #[ORM\Column]
    protected ?string $value = null;

    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(name: "language_code", referencedColumnName: "code")]
    protected ?Language $language = null;

    #[ORM\Column]
    protected ?string $cefrLevel = null;

    #[ORM\Column]
    protected ?string $transcription = null;

    #[ORM\Column]
    protected ?int $frequency = null;

    #[ORM\Column(type: 'json')]
    protected array $tokens = [];

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): void
    {
        $this->language = $language;
    }

    public function getCefrLevel(): ?string
    {
        return $this->cefrLevel;
    }

    public function setCefrLevel(?string $cefrLevel): void
    {
        $this->cefrLevel = $cefrLevel;
    }

    public function getTranscription(): ?string
    {
        return $this->transcription;
    }

    public function setTranscription(?string $transcription): void
    {
        $this->transcription = $transcription;
    }

    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    public function setFrequency(?int $frequency): void
    {
        $this->frequency = $frequency;
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }

    public function setTokens(array $tokens): void
    {
        $this->tokens = $tokens;
    }
}
