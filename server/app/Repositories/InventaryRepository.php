<?php

namespace App\Repositories;

use App\Models\Inventary;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InventaryRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:12 am UTC
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
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Inventary::class;
    }
}
