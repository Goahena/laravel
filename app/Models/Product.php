<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $fillable = [
        'name',
        'shoe_type_id',
        'brand_id',
        'description',
        'slug',
        'price',
        'quantity',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'promotion_id',
        'purchase_quantity',

    ];
    // Quan hệ với ShoeType
    public function shoeType()
    {
        return $this->belongsTo(ShoeType::class, 'shoe_type_id');
    }

    // Quan hệ với Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    // Quan hệ với Brand
    public function promotions()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }
}
