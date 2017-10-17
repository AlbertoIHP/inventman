<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Request",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="locals_id",
 *          description="locals_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="providers_id",
 *          description="providers_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="total",
 *          description="total",
 *          type="number",
 *          format="float"
 *      )
 * )
 */
class Request extends Model
{
	use SoftDeletes;

	public $table = 'requests';
	
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'locals_id',
		'providers_id',
		'total'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'locals_id' => 'integer',
		'providers_id' => 'integer',
		'total' => 'float'
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
	public function provider()
	{
		return $this->belongsTo(\App\Models\Provider::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 **/
	public function requestsdetails()
	{
		return $this->hasMany(\App\Models\Requestsdetail::class);
	}
	protected $hidden = ['remember_token', 'updated_at', 'created_at', 'deleted_at'];	
}
