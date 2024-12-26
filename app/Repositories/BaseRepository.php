<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
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
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });


        if (!empty($join)) {
            $query->join(...$join);
        }
        return $query->paginate($perpage)
                    ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
    public function findByField(
        string $field = '',
        $value,
        array $column = ['*'],
        array $relation = []
    ) {
        return $this->model->select($column)->where($field, '=', $value)->get();
    }
    public function create(array $payload = [])
    {
        $model =  $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->findById($id);
        return $model->update($payload);
    }
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
    public function destroy(int $id = 0)
    {
        return $this->findById($id)->delete();
    }
    public function forceDelete(int $id = 0)
    {
        return $this->findById($id)->forceDelete();
    }
}