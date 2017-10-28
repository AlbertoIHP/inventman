<?php

namespace App\Repositories;

use App\Models\ProductSale;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductSaleRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:14 am UTC
 *
 * @method ProductSale findWithoutFail($id, $columns = ['*'])
 * @method ProductSale find($id, $columns = ['*'])
 * @method ProductSale first($columns = ['*'])
*/
class ProductSaleRepository extends BaseRepository
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
        return ProductSale::class;
    }
}
