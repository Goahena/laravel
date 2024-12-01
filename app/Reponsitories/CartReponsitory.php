<?php

namespace App\Reponsitories;

use App\Models\Product;

class CartReponsitory
{
    public function findProduct($id)
    {
        return Product::find($id);
    }
}
