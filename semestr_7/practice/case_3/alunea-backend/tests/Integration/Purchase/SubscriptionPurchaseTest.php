<?php

namespace App\Tests\Integration\Purchase;

use App\Entity\Provider;
use App\Entity\PurchaseProviderProduct;
use App\Entity\PurchaseTransaction;
use App\Entity\User;
use App\Enum\EnvironmentEnum;
use App\Enum\ProviderEnum;
use App\Enum\PurchaseSourceEnum;
use App\Enum\PurchaseStatusEnum;
use App\Enum\UserSubscriptionStatusEnum;
use App\Exception\Http\PurchaseTransactionProviderGroupNotFoundException;
use App\Exception\ProductInternalAccountConflictException;
use App\Exception\ProductProviderAccountConflictException;
use App\Exception\PurchaseProviderProductProviderMismatchException;
use App\Service\DatabaseService;
use App\Service\PurchaseProviderProductService;
use App\Service\PurchaseTransactionProviderGroupService;
use App\Service\PurchaseTransactionService;
use App\Service\StringService;
use App\Service\UserService;
use App\Service\UserSubscriptionService;
use App\Tests\Factory\ProviderFactory;
use App\Tests\Factory\PurchaseProductFactory;
use App\Tests\Factory\PurchaseProviderProductFactory;
use App\Tests\Factory\UserFactory;
use App\Tests\Integration\AbstractIntegrationTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Clock\Clock;
use Symfony\Component\Clock\DatePoint;

class SubscriptionPurchaseTest extends AbstractIntegrationTestCase
{
    protected UserFactory $userFactory;
    protected PurchaseProductFactory $purchaseProductFactory;
    protected PurchaseProviderProductFactory $purchaseProviderProductFactory;
    protected ProviderFactory $providerFactory;

    protected PurchaseTransactionService $purchaseTransactionService;
    protected PurchaseTransactionProviderGroupService $purchaseTransactionProviderGroupService;
    protected PurchaseProviderProductService $purchaseProviderProductService;
    protected StringService $stringService;
    protected UserSubscriptionService $userSubscriptionService;
    protected DatabaseService $databaseService;
    protected UserService $userService;

    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $container = static::getContainer();
        $this->userFactory = $container->get(UserFactory::class);
        $this->purchaseTransactionService = $container->get(PurchaseTransactionService::class);
        $this->purchaseTransactionProviderGroupService = $container->get(PurchaseTransactionProviderGroupService::class);
        $this->purchaseProductFactory = $container->get(PurchaseProductFactory::class);
        $this->purchaseProviderProductFactory = $container->get(PurchaseProviderProductFactory::class);
        $this->purchaseProviderProductService = $container->get(PurchaseProviderProductService::class);
        $this->stringService = $container->get(StringService::class);
        $this->userSubscriptionService = $container->get(UserSubscriptionService::class);
        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->databaseService = $container->get(DatabaseService::class);
        $this->providerFactory = $container->get(ProviderFactory::class);
        $this->userService = $container->get(UserService::class);
    }



    /**
     * Тест проверяющий первичную покупку
     */
    public function testSubscriptionPurchaseInitial(): void
    {
        $user = $this->userFactory->createUser();
        $providerGoogle = $this->providerFactory->createGoogleProviderIfNotExists();
        $monthlySubscriptionPurchaseProduct = $this->purchaseProductFactory->createMonthlySubscriptionPurchaseProduct();
        $googleMonthlySubscriptionPurchaseProviderProduct = $this->purchaseProviderProductFactory->createSubscriptionPurchaseProviderProduct(
            $providerGoogle,
            $monthlySubscriptionPurchaseProduct
        );

        # 1. Первая покупка
        $purchaseTransaction1 = $this->commitNewPurchaseTransaction(
            user: $user,
            provider: $providerGoogle,
            environment: EnvironmentEnum::PRODUCTION,
            providerGroupId: $this->stringService->createRandomString(),
            providerLinkedGroupId: null,
            source: PurchaseSourceEnum::RECEIPT,
            status: PurchaseStatusEnum::PURCHASED,
            purchaseProviderProduct: $googleMonthlySubscriptionPurchaseProviderProduct,
            transactionId: $this->stringService->createRandomString(),
            purchaseTime: new DatePoint(),
            expireTime: (new DatePoint())->modify('+300 seconds'),
            expectedExceptionClass: null,
            shouldSubscriptionBeChanged: true
        );
    }

    /**
     * Тест проверяющий первичную покупку с продлением
     */
    public function testSubscriptionPurchaseContinue(): void
    {
        $user = $this->userFactory->createUser();
        $providerGoogle = $this->providerFactory->createGoogleProviderIfNotExists();
        $monthlySubscriptionPurchaseProduct = $this->purchaseProductFactory->createMonthlySubscriptionPurchaseProduct();
        $googleMonthlySubscriptionPurchaseProviderProduct = $this->purchaseProviderProductFactory->createSubscriptionPurchaseProviderProduct(
            $providerGoogle,
            $monthlySubscriptionPurchaseProduct
        );

        # 1. Первая покупка
        $purchaseTransaction1 = $this->commitNewPurchaseTransaction(
            user: $user,
            provider: $providerGoogle,
            environment: EnvironmentEnum::PRODUCTION,
            providerGroupId: $this->stringService->createRandomString(),
            providerLinkedGroupId: null,
            source: PurchaseSourceEnum::RECEIPT,
            status: PurchaseStatusEnum::PURCHASED,
            purchaseProviderProduct: $googleMonthlySubscriptionPurchaseProviderProduct,
            transactionId: $this->stringService->createRandomString(),
            purchaseTime: new DatePoint(),
            expireTime: (new DatePoint())->modify('+300 seconds'),
            expectedExceptionClass: null,
            shouldSubscriptionBeChanged: true
        );

        # 2. Продление
        Clock::get()->sleep(300);
        $purchaseTransaction2 = $this->commitNewPurchaseTransaction(
            user: $user,
            provider: $providerGoogle,
            environment: EnvironmentEnum::PRODUCTION,
            providerGroupId: $this->stringService->createRandomString(),
            providerLinkedGroupId: $purchaseTransaction1->getPurchaseTransactionProviderGroup()->getProviderGroupId(),
            source: PurchaseSourceEnum::WEBHOOK,
            status: PurchaseStatusEnum::PURCHASED,
            purchaseProviderProduct: $googleMonthlySubscriptionPurchaseProviderProduct,
            transactionId: $this->stringService->createRandomString(),
            purchaseTime: new DatePoint(),
            expireTime: (new DatePoint())->modify('+300 seconds'),
            expectedExceptionClass: null,
            shouldSubscriptionBeChanged: true
        );
    }

    /**
     * Тест проверяющий возобновление подписки
     */
    public function testSubscriptionPurchaseRenew(): void
    {
        $user = $this->userFactory->createUser();
        $providerGoogle = $this->providerFactory->createGoogleProviderIfNotExists();
        $monthlySubscriptionPurchaseProduct = $this->purchaseProductFactory->createMonthlySubscriptionPurchaseProduct();
        $googleMonthlySubscriptionPurchaseProviderProduct = $this->purchaseProviderProductFactory->createSubscriptionPurchaseProviderProduct(
            $providerGoogle,
            $monthlySubscriptionPurchaseProduct
        );

        # 1. Первая покупка
        $purchaseTransaction1 = $this->commitNewPurchaseTransaction(
            user: $user,
            provider: $providerGoogle,
            environment: EnvironmentEnum::PRODUCTION,
            providerGroupId: $this->stringService->createRandomString(),
            providerLinkedGroupId: null,
            source: PurchaseSourceEnum::RECEIPT,
            status: PurchaseStatusEnum::PURCHASED,
            purchaseProviderProduct: $googleMonthlySubscriptionPurchaseProviderProduct,
            transactionId: $this->stringService->createRandomString(),
            purchaseTime: new DatePoint(),
            expireTime: (new DatePoint())->modify('+300 seconds'),
            expectedExceptionClass: null,
            shouldSubscriptionBeChanged: true
        );

        Clock::get()->sleep(310);

        # 2. Возобновление
        Clock::get()->sleep(300);
        $purchaseTransaction2 = $this->commitNewPurchaseTransaction(
            user: $user,
            provider: $providerGoogle,
            environment: EnvironmentEnum::PRODUCTION,
            providerGroupId: $this->stringService->createRandomString(),
            providerLinkedGroupId: null,
            source: PurchaseSourceEnum::RECEIPT,
            status: PurchaseStatusEnum::PURCHASED,
            purchaseProviderProduct: $googleMonthlySubscriptionPurchaseProviderProduct,
            transactionId: $this->stringService->createRandomString(),
            purchaseTime: new DatePoint(),
            expireTime: (new DatePoint())->modify('+300 seconds'),
            expectedExceptionClass: null,
            shouldSubscriptionBeChanged: true
        );
    }
}