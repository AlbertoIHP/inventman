<?php

use Faker\Factory as Faker;
use App\Models\RequestDetail;
use App\Repositories\RequestDetailRepository;

trait MakeRequestDetailTrait
{
    /**
     * Create fake instance of RequestDetail and save it in database
     *
     * @param array $requestDetailFields
     * @return RequestDetail
     */
    public function makeRequestDetail($requestDetailFields = [])
    {
        /** @var RequestDetailRepository $requestDetailRepo */
        $requestDetailRepo = App::make(RequestDetailRepository::class);
        $theme = $this->fakeRequestDetailData($requestDetailFields);
        return $requestDetailRepo->create($theme);
    }

    /**
     * Get fake instance of RequestDetail
     *
     * @param array $requestDetailFields
     * @return RequestDetail
     */
    public function fakeRequestDetail($requestDetailFields = [])
    {
        return new RequestDetail($this->fakeRequestDetailData($requestDetailFields));
    }

    /**
     * Get fake data of RequestDetail
     *
     * @param array $postFields
     * @return array
     */
    public function fakeRequestDetailData($requestDetailFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'requests_id' => $fake->randomDigitNotNull,
            'products_id' => $fake->randomDigitNotNull,
            'amount' => $fake->randomDigitNotNull
        ], $requestDetailFields);
    }
}
