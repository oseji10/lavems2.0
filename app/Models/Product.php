<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $fillable = ['shopId',
    'name',
    'slug',
    'description',
    'type_id',
    'price',
    'sale_price',
    'language',
    'min_price',
    'max_price',
    'sku',
    'quantity',
    'in_stock',
    'is_taxable',
    'shippig_class_id',
     'status',
     'product_type',
      'unit', 'height',
      'weight',
      'length',
      'image',
      'gallery',
      'author_id',
'manufacturer_id',

];
    protected $table = 'products';
}
