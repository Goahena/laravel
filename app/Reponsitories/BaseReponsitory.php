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

}
