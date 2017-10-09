<?php

namespace App\Repositories;

use App\Models\Request;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RequestRepository
 * @package App\Repositories
 * @version October 9, 2017, 7:11 am UTC
 *
 * @method Request findWithoutFail($id, $columns = ['*'])
 * @method Request find($id, $columns = ['*'])
 * @method Request first($columns = ['*'])
*/
class RequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'locals_id',
        'providers_id',
        'total'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Request::class;
    }
}
