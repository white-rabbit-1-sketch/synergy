<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductProviderAccountConflictHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'This Alunea account is already linked with a different provider account',
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
        return 'product-provider-account-conflict';
    }
}