<?php

namespace App\Controller;

use App\Exception\Http\BadCredentialsHttpException;
use App\Exception\Http\SubscriptionRequiredHttpException;
use App\Exception\Http\UnauthorizedHttpException;
use App\Service\EnvironmentService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use App\Exception\Http\HttpExceptionInterface as InternalHttpExceptionInterface;
use Throwable;

class ErrorController extends AbstractController
{
    public function __construct(
        protected EnvironmentService $environmentService
    )
    {
    }

    public function show(Throwable $exception): JsonResponse
    {
        $response = ['message' => 'Internal server error'];
        if (!$this->environmentService->isProduction()) {
            $response = [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ];
        }
        $responseStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if (
            $exception instanceof UnprocessableEntityHttpException &&
            $exception->getPrevious() instanceof ValidationFailedException
        ) {
            /** @var ValidationFailedException $validationException */
            $validationException = $exception->getPrevious();
            $response = [
                'message' => 'Validation failed',
                'violations' => $this->formatViolations($validationException->getViolations()),
            ];
            $responseStatusCode = $exception->getStatusCode();
        } elseif ($exception instanceof HttpExceptionInterface) {
            $response['message'] = $exception->getMessage();
            $responseStatusCode = $exception->getStatusCode();

            if ($exception instanceof BadCredentialsHttpException) {

            } elseif ($responseStatusCode === Response::HTTP_UNAUTHORIZED) {
                $exception = new UnauthorizedHttpException();
            } elseif ($responseStatusCode === Response::HTTP_PAYMENT_REQUIRED) {
                $exception = new SubscriptionRequiredHttpException();
            }
        }

        if ($exception instanceof InternalHttpExceptionInterface) {
            $response['reason_code'] = $exception->getReasonCode();
        }

        return new JsonResponse($response, $responseStatusCode);
    }

    private function formatViolations(ConstraintViolationListInterface $violations): array
    {
        $errors = [];

        foreach ($violations as $violation) {
            $property = $violation->getPropertyPath();
            $errors[$property][] = $violation->getMessage();
        }

        return $errors;
    }
}
