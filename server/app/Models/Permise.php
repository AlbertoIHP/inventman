<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Permise",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="functionalities_id",
 *          description="functionalities_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="userstypes_id",
 *          description="userstypes_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="write",
 *          description="write",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="delete",
 *          description="delete",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="read",
 *          description="read",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="edit",
 *          description="edit",
 *          type="string"
 *      )
 * )
 */
class Permise extends Model
{
    use SoftDeletes;

    public $table = 'permissions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'functionalities_id',
        'userstypes_id',
        'write',
        'delete',
        'read',
        'edit'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'functionalities_id' => 'integer',
        'userstypes_id' => 'integer',
        'write' => 'string',
        'delete' => 'string',
        'read' => 'string',
        'edit' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function functionality()
    {
        return $this->belongsTo(\App\Models\Functionality::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userstype()
    {
        return $this->belongsTo(\App\Models\Userstype::class);
    }

    	protected $hidden = ['remember_token', 'updated_at', 'created_at', 'deleted_at'];	
}
