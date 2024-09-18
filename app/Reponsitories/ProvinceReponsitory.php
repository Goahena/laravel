<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\ProvinceReponsitoryInterface;
use App\Reponsitories\BaseReponsitoryInterface;
use App\Models\Province;

/**
 * Class UserService
 * @package App\Services
 */
class ProvinceReponsitory extends BaseReponsitory implements ProvinceReponsitoryInterface
{
    protected $model;
    public function __construct(Province $model)
    {
        $this->model = $model;
    }
}
