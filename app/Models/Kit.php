<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kit extends Model
{
    use SoftDeletes;

    protected $table = 'kits';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(KitProduct::class, 'kit_id', 'id')->with('product');
    }

}
