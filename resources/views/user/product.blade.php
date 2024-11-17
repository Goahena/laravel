<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giay extends Model
{
    use HasFactory;

    protected $table = "giay";

    protected $primaryKey = "id_giay";

    public $timestamps = true;

    protected $fillable = [
        'name',
        'shoe_type_name',
        'brand_name',
        'price',
        'description',
        'quantity',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'promotion_name',
        'purchase_quantity',

    ];
}
