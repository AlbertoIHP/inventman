<?php

namespace App\Repositories;

use App\Models\Permise;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PermiseRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:54 am UTC
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
        'delete',
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
