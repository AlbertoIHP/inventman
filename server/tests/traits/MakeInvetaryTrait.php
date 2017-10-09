<?php

use Faker\Factory as Faker;
use App\Models\Invetary;
use App\Repositories\InvetaryRepository;

trait MakeInvetaryTrait
{
    /**
     * Create fake instance of Invetary and save it in database
     *
     * @param array $invetaryFields
     * @return Invetary
     */
    public function makeInvetary($invetaryFields = [])
    {
        /** @var InvetaryRepository $invetaryRepo */
        $invetaryRepo = App::make(InvetaryRepository::class);
        $theme = $this->fakeInvetaryData($invetaryFields);
        return $invetaryRepo->create($theme);
    }

    /**
     * Get fake instance of Invetary
     *
     * @param array $invetaryFields
     * @return Invetary
     */
    public function fakeInvetary($invetaryFields = [])
    {
        return new Invetary($this->fakeInvetaryData($invetaryFields));
    }

    /**
     * Get fake data of Invetary
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInvetaryData($invetaryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'locals_id' => $fake->randomDigitNotNull,
            'products_id' => $fake->randomDigitNotNull,
            'amount' => $fake->randomDigitNotNull
        ], $invetaryFields);
    }
}
