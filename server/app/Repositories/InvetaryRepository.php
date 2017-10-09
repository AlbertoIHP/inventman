<?php

namespace App\Repositories;

use App\Models\Invetary;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class InvetaryRepository
 * @package App\Repositories
 * @version October 9, 2017, 7:10 am UTC
 *
 * @method Invetary findWithoutFail($id, $columns = ['*'])
 * @method Invetary find($id, $columns = ['*'])
 * @method Invetary first($columns = ['*'])
*/
class InvetaryRepository extends BaseRepository
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
        return Invetary::class;
    }
}
