<?php

namespace App\Repositories;

use App\Models\City;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:12 am UTC
 *
 * @method City findWithoutFail($id, $columns = ['*'])
 * @method City find($id, $columns = ['*'])
 * @method City first($columns = ['*'])
*/
class CityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return City::class;
    }
}
