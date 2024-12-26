<?php

namespace App\Repositories;

use App\Repositories\Interfaces\WardRepositoryInterface;
use App\Models\Ward;

/**
 * Class UserService
 * @package App\Services
 */
class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    protected $model;
    public function __construct(Ward $model)
    {
        $this->model = $model;
    }
    public function findWardByDistrictId(?int $district_id = 0)
    {
        if (is_null($district_id) || $district_id === 0) {
            return null;
        }
        
        return $this->model->where('district_code', '=', $district_id)->get();
    }
    
}
