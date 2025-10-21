<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BadCredentialsHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'Bad credentials',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            Response::HTTP_UNAUTHORIZED,
            $message,
            $previous
        );
    }

    public function getReasonCode(): string
    {
        return 'bad-credentials';
    }
}