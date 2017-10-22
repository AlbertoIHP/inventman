<?php

namespace App\Repositories;

use App\Models\RequestBuyDetail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RequestBuyDetailRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:10 pm UTC
 *
 * @method RequestBuyDetail findWithoutFail($id, $columns = ['*'])
 * @method RequestBuyDetail find($id, $columns = ['*'])
 * @method RequestBuyDetail first($columns = ['*'])
*/
class RequestBuyDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'requests_id',
        'products_id',
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RequestBuyDetail::class;
    }
}
