<?php

namespace App\Repositories;

use App\Models\Function;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FunctionRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:11 am UTC
 *
 * @method Function findWithoutFail($id, $columns = ['*'])
 * @method Function find($id, $columns = ['*'])
 * @method Function first($columns = ['*'])
*/
class FunctionRepository extends BaseRepository
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
        return Function::class;
    }
}
