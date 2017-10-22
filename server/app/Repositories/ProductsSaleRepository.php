<?php

namespace App\Repositories;

use App\Models\ProductsSale;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductsSaleRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:33 pm UTC
 *
 * @method ProductsSale findWithoutFail($id, $columns = ['*'])
 * @method ProductsSale find($id, $columns = ['*'])
 * @method ProductsSale first($columns = ['*'])
*/
class ProductsSaleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sales_id',
        'products_id',
        'amount',
        'total'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductsSale::class;
    }
}
