<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SubscriptionRequiredHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'Subscription required',
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            Response::HTTP_PAYMENT_REQUIRED,
            $message,
            $previous
        );
    }

    public function getReasonCode(): string
    {
        return 'subscription-required';
    }
}