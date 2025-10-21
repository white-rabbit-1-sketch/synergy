<?php

namespace App\Exception\Http;

interface HttpExceptionInterface
{
    public function getStatusCode(): int;
    public function getReasonCode(): string;
}