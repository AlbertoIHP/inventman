<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="UserType",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="view",
 *          description="view",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="edit",
 *          description="edit",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="write",
 *          description="write",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="delete",
 *          description="delete",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class UserType extends Model
{
	use SoftDeletes;

	public $table = 'userstypes';
	
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'name',
		'description',
		'view',
		'edit',
		'write',
		'delete'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'description' => 'string',
		'view' => 'integer',
		'edit' => 'integer',
		'write' => 'integer',
		'delete' => 'integer'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [
		
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 **/
	public function users()
	{
		return $this->hasMany(\App\Models\User::class);
	}
	protected $hidden = ['remember_token', 'updated_at', 'created_at', 'deleted_at'];	
}
