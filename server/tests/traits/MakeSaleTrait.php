<?php

use Faker\Factory as Faker;
use App\Models\Sale;
use App\Repositories\SaleRepository;

trait MakeSaleTrait
{
    /**
     * Create fake instance of Sale and save it in database
     *
     * @param array $saleFields
     * @return Sale
     */
    public function makeSale($saleFields = [])
    {
        /** @var SaleRepository $saleRepo */
        $saleRepo = App::make(SaleRepository::class);
        $theme = $this->fakeSaleData($saleFields);
        return $saleRepo->create($theme);
    }

    /**
     * Get fake instance of Sale
     *
     * @param array $saleFields
     * @return Sale
     */
    public function fakeSale($saleFields = [])
    {
        return new Sale($this->fakeSaleData($saleFields));
    }

    /**
     * Get fake data of Sale
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSaleData($saleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'date' => $fake->date('Y-m-d H:i:s'),
            'description' => $fake->word,
            'users_id' => $fake->randomDigitNotNull,
            'totalsale' => $fake->word
        ], $saleFields);
    }
}
