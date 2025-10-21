<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserExistsHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'User exists',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            Response::HTTP_CONFLICT,
            $message,
            $previous
        );
    }

    public function getReasonCode(): string
    {
        return 'user-exists';
    }
}