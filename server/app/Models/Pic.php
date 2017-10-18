<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Pic",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="caption",
 *          description="caption",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="img",
 *          description="img",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="products_id",
 *          description="products_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Pic extends Model
{
	use SoftDeletes;

	public $table = 'pics';
	
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'caption',
		'img',
		'products_id'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'caption' => 'string',
		'img' => 'string',
		'products_id' => 'integer'
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
	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	protected $hidden = ['remember_token', 'updated_at', 'created_at', 'deleted_at'];	
}