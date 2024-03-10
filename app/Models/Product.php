<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     //「商品(products)はカテゴリ(category)に属する」というリレーション関係を定義する
     public function company()
     {
         return $this->belongsTo(Company::class);
     }

    protected $table = 'products';

    protected $fillable = [
        'img_path',
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'updated_at',
        'created_at',
    ];
}
