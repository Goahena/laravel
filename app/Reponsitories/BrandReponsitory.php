<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\BrandReponsitoryInterface;
use App\Reponsitories\BaseReponsitory;
use App\Models\Brand;

/**
 * Class BrandService
 * @package App\Services
 */
class BrandReponsitory extends BaseReponsitory implements BrandReponsitoryInterface
{
    protected $model;
    public function __construct(Brand $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return Brand::paginate(5);
    }
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 10,
        array $relations = []
    ) {
        $query = $this->model
            ->select($column)
            ->with($relations)
            ->when(isset($condition['keyword']) && !empty($condition['keyword']), function ($query) use ($condition) {
                $query->where('brands.brand_name', 'LIKE', '%' . $condition['keyword'] . '%');
            });
    
        return $query->paginate($perpage)
            ->withQueryString()
            ->withPath($extend['path']);
    }
    
}
