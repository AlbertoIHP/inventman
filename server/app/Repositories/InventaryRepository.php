<?php

namespace App\Repositories;

use App\Models\Inventary;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InventaryRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:09 pm UTC
 *
 * @method Inventary findWithoutFail($id, $columns = ['*'])
 * @method Inventary find($id, $columns = ['*'])
 * @method Inventary first($columns = ['*'])
*/
class InventaryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'locals_id',
        'products_id',
        'amount',
        'inventariestypes_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Inventary::class;
    }
}
