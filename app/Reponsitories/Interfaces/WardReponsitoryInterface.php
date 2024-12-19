<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface WardReponsitoryInterface
{
    public function all();
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
}
