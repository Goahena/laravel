<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface ProvinceReponsitoryInterface
{
    public function all();
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
}
