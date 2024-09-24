<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\BaseReponsitoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class BaseReponsitory implements BaseReponsitoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all() {
        return $this->model->all();
    }
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
        ){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
    public function findByField(
        string $field = '',
        $value,
        array $column = ['*'],
        array $relation = []
    ){
        return $this->model->select($column)->where($field, '=', $value)->get();
    }
    public function create(array $payload = []) {
        $model =  $this->model->create($payload);
        return $model->fresh();    
    }
    public function update(int $id = 0, array $payload = []) {
        $model = $this->findById($id);
        return $model->update($payload);
    }
}
