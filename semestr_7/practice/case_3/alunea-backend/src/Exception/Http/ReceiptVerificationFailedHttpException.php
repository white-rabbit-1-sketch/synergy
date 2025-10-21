<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReceiptVerificationFailedHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'Receipt verification failed',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            Response::HTTP_BAD_REQUEST,
            $message,
            $previous
        );
    }

    public function getReasonCode(): string
    {
        return 'receipt-verification-failed';
    }
}