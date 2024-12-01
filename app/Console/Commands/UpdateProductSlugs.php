<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class UpdateProductSlugs extends Command
{
    protected $signature = 'update:product-slugs';
    protected $description = 'Generate slugs for all existing products';

    public function handle()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $product->slug = Str::slug($product->name . '-' . $product->id);
            $product->save();
        }

        $this->info('Slugs updated successfully for all products.');
    }
}
