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
}
