<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface DistrictReponsitoryInterface
{
    public function all();
    public function findDistrictByProvinceId();
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
}
