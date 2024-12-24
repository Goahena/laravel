<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate(){
        return User::paginate(5);
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
            ->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
                      ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
                      ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%')
                      ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%');
            }
        })->with('user_catalogues');
        if (!empty($join)) {
            $query->join(...$join);
        }
        return $query->paginate($perpage)
                    ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
}
