<?php

use Faker\Factory as Faker;
use App\Models\RequestBuy;
use App\Repositories\RequestBuyRepository;

trait MakeRequestBuyTrait
{
    /**
     * Create fake instance of RequestBuy and save it in database
     *
     * @param array $requestBuyFields
     * @return RequestBuy
     */
    public function makeRequestBuy($requestBuyFields = [])
    {
        /** @var RequestBuyRepository $requestBuyRepo */
        $requestBuyRepo = App::make(RequestBuyRepository::class);
        $theme = $this->fakeRequestBuyData($requestBuyFields);
        return $requestBuyRepo->create($theme);
    }

    /**
     * Get fake instance of RequestBuy
     *
     * @param array $requestBuyFields
     * @return RequestBuy
     */
    public function fakeRequestBuy($requestBuyFields = [])
    {
        return new RequestBuy($this->fakeRequestBuyData($requestBuyFields));
    }

    /**
     * Get fake data of RequestBuy
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRequestBuyData($requestBuyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'locals_id' => $fake->randomDigitNotNull,
            'providers_id' => $fake->randomDigitNotNull,
            'total' => $fake->randomDigitNotNull
        ], $requestBuyFields);
    }
}
