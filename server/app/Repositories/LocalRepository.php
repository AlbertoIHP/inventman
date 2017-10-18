<?php

namespace App\Repositories;

use App\Models\Local;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LocalRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:08 pm UTC
 *
 * @method Local findWithoutFail($id, $columns = ['*'])
 * @method Local find($id, $columns = ['*'])
 * @method Local first($columns = ['*'])
*/
class LocalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'address',
        'name',
        'city_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Local::class;
    }
}
