<?php

namespace App\Repositories;

use App\Models\ProductType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductTypeRepository
 * @package App\Repositories
 * @version October 27, 2017, 5:27 am UTC
 *
 * @method ProductType findWithoutFail($id, $columns = ['*'])
 * @method ProductType find($id, $columns = ['*'])
 * @method ProductType first($columns = ['*'])
*/
class ProductTypeRepository extends BaseRepository
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
        return ProductType::class;
    }
}
