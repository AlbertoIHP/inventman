<?php

namespace App\Repositories;

use App\Models\UserType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserTypeRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:08 pm UTC
 *
 * @method UserType findWithoutFail($id, $columns = ['*'])
 * @method UserType find($id, $columns = ['*'])
 * @method UserType first($columns = ['*'])
*/
class UserTypeRepository extends BaseRepository
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
        return UserType::class;
    }
}
