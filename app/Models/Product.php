<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function kit()
    {
        return $this->hasMany(KitProduct::class, 'product_id', 'id')->with('Kit');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
