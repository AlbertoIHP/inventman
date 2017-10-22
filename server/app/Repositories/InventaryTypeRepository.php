<?php

namespace App\Repositories;

use App\Models\InventaryType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InventaryTypeRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:09 pm UTC
 *
 * @method InventaryType findWithoutFail($id, $columns = ['*'])
 * @method InventaryType find($id, $columns = ['*'])
 * @method InventaryType first($columns = ['*'])
*/
class InventaryTypeRepository extends BaseRepository
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
        return InventaryType::class;
    }
}
