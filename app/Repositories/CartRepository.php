<?php

namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function findProduct($id)
    {
        return Product::find($id);
    }
}
