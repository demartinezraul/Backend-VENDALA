<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class KitProduct extends Model
{
    protected $table = 'kit_products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'kit_id',
        'product_id'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function kit()
    {
        return $this->hasOne(Kit::class, 'id', 'kit_id');
    }

}
