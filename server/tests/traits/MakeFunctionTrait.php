<?php

use Faker\Factory as Faker;
use App\Models\Function;
use App\Repositories\FunctionRepository;

trait MakeFunctionTrait
{
    /**
     * Create fake instance of Function and save it in database
     *
     * @param array $functionFields
     * @return Function
     */
    public function makeFunction($functionFields = [])
    {
        /** @var FunctionRepository $functionRepo */
        $functionRepo = App::make(FunctionRepository::class);
        $theme = $this->fakeFunctionData($functionFields);
        return $functionRepo->create($theme);
    }

    /**
     * Get fake instance of Function
     *
     * @param array $functionFields
     * @return Function
     */
    public function fakeFunction($functionFields = [])
    {
        return new Function($this->fakeFunctionData($functionFields));
    }

    /**
     * Get fake data of Function
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFunctionData($functionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->word
        ], $functionFields);
    }
}
