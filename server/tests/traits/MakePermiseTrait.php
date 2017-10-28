<?php

use Faker\Factory as Faker;
use App\Models\Permise;
use App\Repositories\PermiseRepository;

trait MakePermiseTrait
{
    /**
     * Create fake instance of Permise and save it in database
     *
     * @param array $permiseFields
     * @return Permise
     */
    public function makePermise($permiseFields = [])
    {
        /** @var PermiseRepository $permiseRepo */
        $permiseRepo = App::make(PermiseRepository::class);
        $theme = $this->fakePermiseData($permiseFields);
        return $permiseRepo->create($theme);
    }

    /**
     * Get fake instance of Permise
     *
     * @param array $permiseFields
     * @return Permise
     */
    public function fakePermise($permiseFields = [])
    {
        return new Permise($this->fakePermiseData($permiseFields));
    }

    /**
     * Get fake data of Permise
     *
     * @param array $postFields
     * @return array
     */
    public function fakePermiseData($permiseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'functionalities_id' => $fake->randomDigitNotNull,
            'userstypes_id' => $fake->randomDigitNotNull,
            'write' => $fake->word,
            'delete' => $fake->word,
            'read' => $fake->word,
            'edit' => $fake->word
        ], $permiseFields);
    }
}
