<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Product",
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
 *          property="providers_id",
 *          description="providers_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cost",
 *          description="cost",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="productstypes_id",
 *          description="productstypes_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="productscategories_id",
 *          description="productscategories_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'providers_id',
        'price',
        'cost',
        'productstypes_id',
        'code',
        'productscategories_id'
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
        'providers_id' => 'integer',
        'price' => 'string',
        'cost' => 'string',
        'productstypes_id' => 'integer',
        'code' => 'string',
        'productscategories_id' => 'integer'
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
    public function productscategory()
    {
        return $this->belongsTo(\App\Models\Productscategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function productstype()
    {
        return $this->belongsTo(\App\Models\Productstype::class);
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
    public function inventaries()
    {
        return $this->hasMany(\App\Models\Inventary::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pics()
    {
        return $this->hasMany(\App\Models\Pic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productssales()
    {
        return $this->hasMany(\App\Models\Productssale::class);
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
