<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * @SWG\Definition(
 *      definition="User",
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
 *          property="lastname",
 *          description="lastname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="rut",
 *          description="rut",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="userstypes_id",
 *          description="userstypes_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="local_id",
 *          description="local_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class User extends Authenticatable
{
	use SoftDeletes;

	public $table = 'users';
	
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'name',
		'lastname',
		'rut',
		'email',
		'phone',
		'password',
		'userstypes_id',
		'local_id'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'name' => 'string',
		'lastname' => 'string',
		'rut' => 'string',
		'email' => 'string',
		'phone' => 'string',
		'password' => 'string',
		'userstypes_id' => 'integer',
		'local_id' => 'integer'
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
	public function local()
	{
		return $this->belongsTo(\App\Models\Local::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 **/
	public function userstype()
	{
		return $this->belongsTo(\App\Models\Userstype::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 **/
	public function sales()
	{
		return $this->hasMany(\App\Models\Sale::class);
	}

	protected $hidden = ['remember_token', 'updated_at', 'created_at', 'deleted_at'];	
}