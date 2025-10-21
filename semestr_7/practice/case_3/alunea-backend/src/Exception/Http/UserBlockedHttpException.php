<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserBlockedHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'User blocked',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            Response::HTTP_FORBIDDEN,
            $message,
            $previous
        );
    }

    public function getReasonCode(): string
    {
        return 'user-blocked';
    }
}