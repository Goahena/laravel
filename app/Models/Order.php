<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = "order";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $fillable = ['name', 'phone', 'payment_method', 'address', 'description', 'total_price', 'invoice'];
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
