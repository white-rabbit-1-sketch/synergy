<?php

namespace App\Dto\Controller\Response\Purchase;

use App\Dto\Controller\Response\AbstractResponseDto;

class GetPurchaseProviderProductsResponseDto extends AbstractResponseDto
{
    public function __construct(
        protected array $purchaseProviderProducts,
    )
    {
    }

    public function getPurchaseProviderProducts(): array
    {
        return $this->purchaseProviderProducts;
    }

    public function setPurchaseProviderProducts(array $purchaseProviderProducts): void
    {
        $this->purchaseProviderProducts = $purchaseProviderProducts;
    }
}