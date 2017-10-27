<?php

use Faker\Factory as Faker;
use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;

trait MakeProductCategoryTrait
{
    /**
     * Create fake instance of ProductCategory and save it in database
     *
     * @param array $productCategoryFields
     * @return ProductCategory
     */
    public function makeProductCategory($productCategoryFields = [])
    {
        /** @var ProductCategoryRepository $productCategoryRepo */
        $productCategoryRepo = App::make(ProductCategoryRepository::class);
        $theme = $this->fakeProductCategoryData($productCategoryFields);
        return $productCategoryRepo->create($theme);
    }

    /**
     * Get fake instance of ProductCategory
     *
     * @param array $productCategoryFields
     * @return ProductCategory
     */
    public function fakeProductCategory($productCategoryFields = [])
    {
        return new ProductCategory($this->fakeProductCategoryData($productCategoryFields));
    }

    /**
     * Get fake data of ProductCategory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProductCategoryData($productCategoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word
        ], $productCategoryFields);
    }
}
