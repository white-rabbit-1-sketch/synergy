<?php

namespace App\Tests\Factory;

use App\Entity\Provider;
use App\Entity\PurchaseProduct\SubscriptionPurchaseProduct;
use App\Entity\PurchaseProviderProduct;
use App\Repository\PurchaseProviderProductRepository;
use App\Service\StringService;

class PurchaseProviderProductFactory
{
    public function __construct(
        protected PurchaseProviderProductRepository $purchaseProviderProductRepository,
        protected ProviderFactory $providerFactory,
        protected StringService $stringService
    )
    {
    }

    public function createSubscriptionPurchaseProviderProduct(
        Provider $provider,
        SubscriptionPurchaseProduct $subscriptionPurchaseProduct,
    ): PurchaseProviderProduct
    {
        $purchaseProviderProduct = new PurchaseProviderProduct();
        $purchaseProviderProduct->setProvider($provider);
        $purchaseProviderProduct->setProviderProductId($this->stringService->createRandomString());
        $purchaseProviderProduct->setPurchaseProduct($subscriptionPurchaseProduct);
        $purchaseProviderProduct->setPriority(1);

        $this->purchaseProviderProductRepository->save($purchaseProviderProduct);

        return $purchaseProviderProduct;
    }
}