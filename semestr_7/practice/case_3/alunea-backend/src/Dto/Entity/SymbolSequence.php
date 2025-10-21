<?php

namespace App\Dto\Entity;

class SymbolSequence
{
    public const TYPE = 'symbol-sequence';

    public function __construct(
        protected string $value
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

    public function getType(): string
    {
        return static::TYPE;
    }
}