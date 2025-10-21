<?php

namespace App\Controller;

use App\Dto\Controller\Response\Purchase\GetPurchaseProviderProductsResponseDto;
use App\Enum\PurchaseProductTypeEnum;
use App\Exception\Http\ProductInternalAccountConflictHttpException;
use App\Exception\Http\ProductProviderAccountConflictHttpException;
use App\Exception\ProductInternalAccountConflictException;
use App\Exception\ProductProviderAccountConflictException;
use App\Service\ProviderService;
use App\Service\PurchaseProviderProductService;
use App\Service\PurchaseReceiptService;
use App\Service\UserSubscriptionService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(format: 'json')]
class PurchaseController extends AbstractController
{
    public function __construct(
        protected PurchaseReceiptService         $purchaseReceiptService,
        protected UserSubscriptionService        $userSubscriptionService,
        protected PurchaseProviderProductService $purchaseProviderProductService,
        protected ProviderService                $providerService,
        protected LoggerInterface                $logger
    )
    {
    }

    #[Route('/v1/purchase/provider/products/{provider}/{type}', methods: ['GET'])]
    #[IsGranted('ROLE_USER', message: 'Unauthorized', statusCode: 401)]
    public function getPurchaseProviderProducts(
        string $provider,
        string $type,
    ): JsonResponse
    {
        if (!in_array($type, PurchaseProductTypeEnum::getTypeList())) {
            throw $this->createNotFoundException();
        }

        $provider = $this->providerService->getProviderByCode($provider);
        if (!$provider) {
            $this->createNotFoundException();
        }

        $purchaseProviderProducts = $this->purchaseProviderProductService->getPurchaseProviderProductsByProviderAndPurchaseProductType(
            $provider,
            $type
        );

        return $this->json(new GetPurchaseProviderProductsResponseDto(
            $purchaseProviderProducts
        ));
    }
}