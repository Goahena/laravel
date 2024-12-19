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

    protected $fillable = ['name', 'phone', 'payment_method', 'address', 'description', 'total_price', 'invoice', 'created_at', 'updated_at', 'status'];

    // Status Constants
    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_SHIPPING = 2;
    const STATUS_PAID = 3;

    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => 'Chưa xác nhận',
            self::STATUS_CONFIRMED => 'Đã xác nhận',
            self::STATUS_SHIPPING => 'Đang vận chuyển',
            self::STATUS_PAID => 'Đã hoàn thành',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::getStatusList()[$this->status];
    }

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

    public function promotions()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }
}