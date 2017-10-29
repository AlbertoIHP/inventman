<?php

namespace App\Repositories;

use App\Models\Permise;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PermiseRepository
 * @package App\Repositories
 * @version October 29, 2017, 4:31 am UTC
 *
 * @method Permise findWithoutFail($id, $columns = ['*'])
 * @method Permise find($id, $columns = ['*'])
 * @method Permise first($columns = ['*'])
*/
class PermiseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'functionalities_id',
        'userstypes_id',
        'write',
        'erase',
        'read',
        'edit'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permise::class;
    }
}
