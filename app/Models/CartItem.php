<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // علاقة الربط مع السلة
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // تعديل اسم الدالة هنا لتصبح product بدلاً من user
    public function product()
    {
        return $this->belongsTo(ProductsModel::class, 'product_id');
    }
}