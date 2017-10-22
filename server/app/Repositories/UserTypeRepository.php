<?php

namespace App\Repositories;

use App\Models\UserType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserTypeRepository
 * @package App\Repositories
 * @version October 22, 2017, 11:34 pm UTC
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
        'description',
        'view',
        'edit',
        'write',
        'delete'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserType::class;
    }
}
