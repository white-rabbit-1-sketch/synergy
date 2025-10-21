<?php

namespace App\Dto\Entity\Ai;

class WordTranscription
{
    protected string $transcription;

    public function __construct(string $transcription)
    {
        $this->transcription = $transcription;
    }

    public function getTranscription(): string
    {
        return $this->transcription;
    }

    public function setTranscription(string $transcription): void
    {
        $this->transcription = $transcription;
    }
}