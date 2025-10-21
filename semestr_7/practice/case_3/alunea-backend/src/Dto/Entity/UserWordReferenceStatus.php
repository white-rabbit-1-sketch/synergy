<?php

namespace App\Dto\Entity;

class UserWordReferenceStatus
{
    public function __construct(
        protected string $value,
        protected string $status,
    )
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}