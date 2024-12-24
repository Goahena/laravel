<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PromotionRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Promotion;

/**
 * Class PromotionService
 * @package App\Services
 */
class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    protected $model;
    public function __construct(Promotion $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return Promotion::paginate(5);
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
                $query->where('promotions.promotion_name', 'LIKE', '%' . $condition['keyword'] . '%');
            });
    
        return $query->paginate($perpage)
            ->withQueryString()
            ->withPath($extend['path']);
    }
    
}
