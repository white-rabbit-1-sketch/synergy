<?php

namespace App\Tests\Factory;

use App\Entity\PurchaseProduct\SubscriptionPurchaseProduct;
use App\Enum\SubscriptionPurchaseProductPeriodTypeEnum;
use App\Repository\PurchaseProductRepository;
use App\Service\StringService;

class PurchaseProductFactory
{
    public function __construct(
        protected PurchaseProductRepository $purchaseProductRepository,
        protected StringService $stringService
    )
    {
    }

    public function createMonthlySubscriptionPurchaseProduct(): SubscriptionPurchaseProduct
    {
        $subscriptionPurchaseProduct = new SubscriptionPurchaseProduct();
        $subscriptionPurchaseProduct->setTitle($this->stringService->createRandomString());
        $subscriptionPurchaseProduct->setPeriodType(SubscriptionPurchaseProductPeriodTypeEnum::PERIOD_TYPE_MONTH);
        $subscriptionPurchaseProduct->setPeriodValue(1);

        $this->purchaseProductRepository->save($subscriptionPurchaseProduct);

        return $subscriptionPurchaseProduct;
    }

    public function createYearlySubscriptionPurchaseProduct(): SubscriptionPurchaseProduct
    {
        $subscriptionPurchaseProduct = new SubscriptionPurchaseProduct();
        $subscriptionPurchaseProduct->setTitle($this->stringService->createRandomString());
        $subscriptionPurchaseProduct->setPeriodType(SubscriptionPurchaseProductPeriodTypeEnum::PERIOD_TYPE_YEAR);
        $subscriptionPurchaseProduct->setPeriodValue(1);

        $this->purchaseProductRepository->save($subscriptionPurchaseProduct);

        return $subscriptionPurchaseProduct;
    }
}