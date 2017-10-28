<?php

namespace App\Repositories;

use App\Models\Sale;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SaleRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:14 am UTC
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
        'totalsale'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sale::class;
    }
}
