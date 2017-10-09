<?php

namespace App\Repositories;

use App\Models\RequestDetail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RequestDetailRepository
 * @package App\Repositories
 * @version October 9, 2017, 7:11 am UTC
 *
 * @method RequestDetail findWithoutFail($id, $columns = ['*'])
 * @method RequestDetail find($id, $columns = ['*'])
 * @method RequestDetail first($columns = ['*'])
*/
class RequestDetailRepository extends BaseRepository
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
        return RequestDetail::class;
    }
}
