<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\DistrictReponsitoryInterface;
use App\Models\District;

/**
 * Class UserService
 * @package App\Services
 */
class DistrictReponsitory extends BaseReponsitory implements DistrictReponsitoryInterface
{
    protected $model;
    public function __construct(District $model)
    {
        $this->model = $model;
    }
    public function findDistrictByProvinceId(int $province_id = 0) {
        return $this->model->where('province_code', '=', $province_id)->get();
    }
}
