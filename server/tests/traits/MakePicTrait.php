<?php

use Faker\Factory as Faker;
use App\Models\Pic;
use App\Repositories\PicRepository;

trait MakePicTrait
{
    /**
     * Create fake instance of Pic and save it in database
     *
     * @param array $picFields
     * @return Pic
     */
    public function makePic($picFields = [])
    {
        /** @var PicRepository $picRepo */
        $picRepo = App::make(PicRepository::class);
        $theme = $this->fakePicData($picFields);
        return $picRepo->create($theme);
    }

    /**
     * Get fake instance of Pic
     *
     * @param array $picFields
     * @return Pic
     */
    public function fakePic($picFields = [])
    {
        return new Pic($this->fakePicData($picFields));
    }

    /**
     * Get fake data of Pic
     *
     * @param array $postFields
     * @return array
     */
    public function fakePicData($picFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'caption' => $fake->word,
            'img' => $fake->word,
            'products_id' => $fake->randomDigitNotNull
        ], $picFields);
    }
}
