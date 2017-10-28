<?php

use Faker\Factory as Faker;
use App\Models\ProductSale;
use App\Repositories\ProductSaleRepository;

trait MakeProductSaleTrait
{
    /**
     * Create fake instance of ProductSale and save it in database
     *
     * @param array $productSaleFields
     * @return ProductSale
     */
    public function makeProductSale($productSaleFields = [])
    {
        /** @var ProductSaleRepository $productSaleRepo */
        $productSaleRepo = App::make(ProductSaleRepository::class);
        $theme = $this->fakeProductSaleData($productSaleFields);
        return $productSaleRepo->create($theme);
    }

    /**
     * Get fake instance of ProductSale
     *
     * @param array $productSaleFields
     * @return ProductSale
     */
    public function fakeProductSale($productSaleFields = [])
    {
        return new ProductSale($this->fakeProductSaleData($productSaleFields));
    }

    /**
     * Get fake data of ProductSale
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProductSaleData($productSaleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'sales_id' => $fake->randomDigitNotNull,
            'products_id' => $fake->randomDigitNotNull,
            'amount' => $fake->word,
            'total' => $fake->word
        ], $productSaleFields);
    }
}
