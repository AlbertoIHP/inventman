<?php

namespace App\Repositories;

use App\Models\Provider;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProviderRepository
 * @package App\Repositories
 * @version October 28, 2017, 12:13 am UTC
 *
 * @method Provider findWithoutFail($id, $columns = ['*'])
 * @method Provider find($id, $columns = ['*'])
 * @method Provider first($columns = ['*'])
*/
class ProviderRepository extends BaseRepository
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
        return Provider::class;
    }
}
