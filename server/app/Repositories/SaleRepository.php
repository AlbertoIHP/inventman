<?php

namespace App\Repositories;

use App\Models\Sale;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SaleRepository
 * @package App\Repositories
 * @version October 29, 2017, 8:19 am UTC
 *
 * @method Sale findWithoutFail($id, $columns = ['*'])
 * @method Sale find($id, $columns = ['*'])
 * @method Sale first($columns = ['*'])
*/
class SaleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'description',
        'users_id',
        'totalsale',
        'time'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sale::class;
    }
}
