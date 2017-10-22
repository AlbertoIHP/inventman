<?php

use Faker\Factory as Faker;
use App\Models\ProductsSale;
use App\Repositories\ProductsSaleRepository;

trait MakeProductsSaleTrait
{
    /**
     * Create fake instance of ProductsSale and save it in database
     *
     * @param array $productsSaleFields
     * @return ProductsSale
     */
    public function makeProductsSale($productsSaleFields = [])
    {
        /** @var ProductsSaleRepository $productsSaleRepo */
        $productsSaleRepo = App::make(ProductsSaleRepository::class);
        $theme = $this->fakeProductsSaleData($productsSaleFields);
        return $productsSaleRepo->create($theme);
    }

    /**
     * Get fake instance of ProductsSale
     *
     * @param array $productsSaleFields
     * @return ProductsSale
     */
    public function fakeProductsSale($productsSaleFields = [])
    {
        return new ProductsSale($this->fakeProductsSaleData($productsSaleFields));
    }

    /**
     * Get fake data of ProductsSale
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProductsSaleData($productsSaleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'sales_id' => $fake->randomDigitNotNull,
            'products_id' => $fake->randomDigitNotNull,
            'amount' => $fake->word,
            'total' => $fake->word
        ], $productsSaleFields);
    }
}
