<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\ShoeType;
use App\Models\Brand;
use App\Models\Promotion;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return Product::paginate(5);
    }
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 5,
        array $relations = []
    ) {
        $query = $this->model
            ->select($column)
            ->with($relations)
            ->leftJoin('shoe_types', 'product.shoe_type_id', '=', 'shoe_types.id')
            ->leftJoin('brands', 'product.brand_id', '=', 'brands.id')
            ->leftJoin('promotions', 'product.promotion_id', '=', 'promotions.id')
            ->when(isset($condition['keyword']) && !empty($condition['keyword']), function ($query) use ($condition) {
                $query->where('product.name', 'LIKE', '%' . $condition['keyword'] . '%');
            })
            ->when(isset($condition['shoeType']), function ($query) use ($condition) {
                $query->where('shoe_types.id', $condition['shoeType']);
            })
            ->when(isset($condition['brand']), function ($query) use ($condition) {
                $query->where('brands.id', $condition['brand']);
            })
            ->when(isset($condition['promotion']), function ($query) use ($condition) {
                $query->where('promotions.id', $condition['promotion']);
            });
    
        return $query->paginate($perpage)
            ->withQueryString()
            ->withPath($extend['path']);
    }
    public function decrementQuantity(Product $product, $quantity)
    {
        $product->decrement('quantity', $quantity);
        $product->decrement('reserved_quantity', $quantity);
    }

    public function releaseReservedQuantity(Product $product, $quantity)
    {
        if ($product->reserved_quantity >= $quantity) {
            $product->decrement('reserved_quantity', $quantity);
        }
    }
}
