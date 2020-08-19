<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'picture',
        'code_category',
        'category_id'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
