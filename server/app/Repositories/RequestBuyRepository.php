<?php

namespace App\Repositories;

use App\Models\RequestBuy;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RequestBuyRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:09 pm UTC
 *
 * @method RequestBuy findWithoutFail($id, $columns = ['*'])
 * @method RequestBuy find($id, $columns = ['*'])
 * @method RequestBuy first($columns = ['*'])
*/
class RequestBuyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'locals_id',
        'providers_id',
        'total'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RequestBuy::class;
    }
}
