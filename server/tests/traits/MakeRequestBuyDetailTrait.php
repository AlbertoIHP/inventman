<?php

use Faker\Factory as Faker;
use App\Models\RequestBuyDetail;
use App\Repositories\RequestBuyDetailRepository;

trait MakeRequestBuyDetailTrait
{
    /**
     * Create fake instance of RequestBuyDetail and save it in database
     *
     * @param array $requestBuyDetailFields
     * @return RequestBuyDetail
     */
    public function makeRequestBuyDetail($requestBuyDetailFields = [])
    {
        /** @var RequestBuyDetailRepository $requestBuyDetailRepo */
        $requestBuyDetailRepo = App::make(RequestBuyDetailRepository::class);
        $theme = $this->fakeRequestBuyDetailData($requestBuyDetailFields);
        return $requestBuyDetailRepo->create($theme);
    }

    /**
     * Get fake instance of RequestBuyDetail
     *
     * @param array $requestBuyDetailFields
     * @return RequestBuyDetail
     */
    public function fakeRequestBuyDetail($requestBuyDetailFields = [])
    {
        return new RequestBuyDetail($this->fakeRequestBuyDetailData($requestBuyDetailFields));
    }

    /**
     * Get fake data of RequestBuyDetail
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRequestBuyDetailData($requestBuyDetailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'requests_id' => $fake->randomDigitNotNull,
            'products_id' => $fake->randomDigitNotNull,
            'amount' => $fake->randomDigitNotNull
        ], $requestBuyDetailFields);
    }
}
