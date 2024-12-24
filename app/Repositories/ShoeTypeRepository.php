<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ShoeTypeRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\ShoeType;

/**
 * Class ShoeTypeService
 * @package App\Services
 */
class ShoeTypeRepository extends BaseRepository implements ShoeTypeRepositoryInterface
{
    protected $model;
    public function __construct(ShoeType $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return ShoeType::paginate(5);
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
                $query->where('shoe_types.shoe_type_name', 'LIKE', '%' . $condition['keyword'] . '%');
            });
    
        return $query->paginate($perpage)
            ->withQueryString()
            ->withPath($extend['path']);
    }
    
}
