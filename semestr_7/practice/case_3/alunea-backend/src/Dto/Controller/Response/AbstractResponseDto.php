<?php

namespace App\Dto\Controller\Response;

abstract class AbstractResponseDto
{
    public const STATUS_OK = 'ok';
    public const STATUS_ERROR = 'error';

    protected string $status = self::STATUS_OK;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}