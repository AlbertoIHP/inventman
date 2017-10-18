<?php

use Faker\Factory as Faker;
use App\Models\InventaryType;
use App\Repositories\InventaryTypeRepository;

trait MakeInventaryTypeTrait
{
    /**
     * Create fake instance of InventaryType and save it in database
     *
     * @param array $inventaryTypeFields
     * @return InventaryType
     */
    public function makeInventaryType($inventaryTypeFields = [])
    {
        /** @var InventaryTypeRepository $inventaryTypeRepo */
        $inventaryTypeRepo = App::make(InventaryTypeRepository::class);
        $theme = $this->fakeInventaryTypeData($inventaryTypeFields);
        return $inventaryTypeRepo->create($theme);
    }

    /**
     * Get fake instance of InventaryType
     *
     * @param array $inventaryTypeFields
     * @return InventaryType
     */
    public function fakeInventaryType($inventaryTypeFields = [])
    {
        return new InventaryType($this->fakeInventaryTypeData($inventaryTypeFields));
    }

    /**
     * Get fake data of InventaryType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInventaryTypeData($inventaryTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->word
        ], $inventaryTypeFields);
    }
}
