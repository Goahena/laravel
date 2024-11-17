<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductReponsitoryInterface extends BaseReponsitoryInterface
{
    public function getAllPaginate();
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
}
