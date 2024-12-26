<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Models\District;

/**
 * Class UserService
 * @package App\Services
 */
class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    protected $model;
    public function __construct(District $model)
    {
        $this->model = $model;
    }
    public function findDistrictByProvinceId(?int $province_id = 0)
    {
        if (is_null($province_id) || $province_id === 0) {
            return null;
        }
        
        return $this->model->where('province_code', '=', $province_id)->get();
    }
    
}
