<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $fillable = ['name', 'is_active'];

    public function products()
    {
        return $this->hasMany(ProductsModel::class);
    }
}
