<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductCategoryRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:13 am UTC
 *
 * @method ProductCategory findWithoutFail($id, $columns = ['*'])
 * @method ProductCategory find($id, $columns = ['*'])
 * @method ProductCategory first($columns = ['*'])
*/
class ProductCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductCategory::class;
    }
}
