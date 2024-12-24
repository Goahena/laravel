<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface BrandRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();
    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    );
}
