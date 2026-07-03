<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $fillable = ['file', "name", 'is_active'];


    public function products()
    {
        return $this->hasMany(ProductsModel::class, 'category_id');
    }
}
