<?php

namespace App\Service;

class StringService
{
    public function createRandomString(): string
    {
        return uniqid('', true);
    }

    public function normalizeStringAsCleanPhrase(string $value): string
    {
        return preg_replace('/[^0-9-\'\"\?\.\,\s\p{L}]+/u', '', $value);
    }
}