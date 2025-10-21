<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TooManyRequestsHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'Requests rate limit exceeded',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            Response::HTTP_TOO_MANY_REQUESTS,
            $message,
            $previous
        );
    }

    public function getReasonCode(): string
    {
        return 'too-many-requests';
    }
}