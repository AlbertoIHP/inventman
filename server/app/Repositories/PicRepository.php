<?php

namespace App\Repositories;

use App\Models\Pic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PicRepository
 * @package App\Repositories
 * @version October 18, 2017, 12:17 pm UTC
 *
 * @method Pic findWithoutFail($id, $columns = ['*'])
 * @method Pic find($id, $columns = ['*'])
 * @method Pic first($columns = ['*'])
*/
class PicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'caption',
        'img',
        'products_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pic::class;
    }
}
