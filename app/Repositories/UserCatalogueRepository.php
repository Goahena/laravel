<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\UserCatalogue;

/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueRepository extends BaseRepository implements UserCatalogueRepositoryInterface
{
    protected $model;
    public function __construct(UserCatalogue $model)
    {
        $this->model = $model;
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
            ->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
                      ->orWhere('description', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });
        
        if (isset($relations) && !empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }
        if (!empty($join)) {
            $query->join(...$join);
        }
        return $query->paginate($perpage)
                    ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
