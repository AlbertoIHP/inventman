<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Inventary",
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
 *          property="products_id",
 *          description="products_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="inventariestypes_id",
 *          description="inventariestypes_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Inventary extends Model
{
	use SoftDeletes;

	public $table = 'inventaries';
	
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'locals_id',
		'products_id',
		'amount',
		'inventariestypes_id'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'locals_id' => 'integer',
		'products_id' => 'integer',
		'amount' => 'integer',
		'inventariestypes_id' => 'integer'
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
	public function inventariestype()
	{
		return $this->belongsTo(\App\Models\Inventariestype::class);
	}

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
	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	protected $hidden = ['remember_token', 'updated_at', 'created_at', 'deleted_at'];	
}