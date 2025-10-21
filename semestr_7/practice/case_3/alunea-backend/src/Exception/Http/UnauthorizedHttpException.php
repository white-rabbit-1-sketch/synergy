<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'Unauthorized',
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
        return 'unauthorized';
    }
}