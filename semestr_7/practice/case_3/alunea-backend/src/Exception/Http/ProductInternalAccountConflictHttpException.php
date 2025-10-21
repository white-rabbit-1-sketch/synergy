<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductInternalAccountConflictHttpException
    extends HttpException implements HttpExceptionInterface
{
    public function __construct(
        string $message = 'This product is already associated with another account',
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
        return 'product-internal-account-conflict';
    }
}