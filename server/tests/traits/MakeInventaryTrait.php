<?php

use Faker\Factory as Faker;
use App\Models\Inventary;
use App\Repositories\InventaryRepository;

trait MakeInventaryTrait
{
    /**
     * Create fake instance of Inventary and save it in database
     *
     * @param array $inventaryFields
     * @return Inventary
     */
    public function makeInventary($inventaryFields = [])
    {
        /** @var InventaryRepository $inventaryRepo */
        $inventaryRepo = App::make(InventaryRepository::class);
        $theme = $this->fakeInventaryData($inventaryFields);
        return $inventaryRepo->create($theme);
    }

    /**
     * Get fake instance of Inventary
     *
     * @param array $inventaryFields
     * @return Inventary
     */
    public function fakeInventary($inventaryFields = [])
    {
        return new Inventary($this->fakeInventaryData($inventaryFields));
    }

    /**
     * Get fake data of Inventary
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInventaryData($inventaryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'locals_id' => $fake->randomDigitNotNull,
            'products_id' => $fake->randomDigitNotNull,
            'amount' => $fake->randomDigitNotNull
        ], $inventaryFields);
    }
}
