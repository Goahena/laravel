<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\WardReponsitoryInterface;
use App\Models\Ward;

/**
 * Class UserService
 * @package App\Services
 */
class WardReponsitory extends BaseReponsitory implements WardReponsitoryInterface
{
    protected $model;
    public function __construct(Ward $model)
    {
        $this->model = $model;
    }
}
