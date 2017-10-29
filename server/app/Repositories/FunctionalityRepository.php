<?php

namespace App\Repositories;

use App\Models\Functionality;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FunctionalityRepository
 * @package App\Repositories
 * @version October 29, 2017, 2:34 am UTC
 *
 * @method Functionality findWithoutFail($id, $columns = ['*'])
 * @method Functionality find($id, $columns = ['*'])
 * @method Functionality first($columns = ['*'])
*/
class FunctionalityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Functionality::class;
    }
}
