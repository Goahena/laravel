<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = "promotions";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = ['promotion_name', 'promotion_value'];
}
