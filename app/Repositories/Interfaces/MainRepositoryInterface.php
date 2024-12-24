<?php

namespace App\Repositories\Interfaces;

/**
 * Interface MainServiceInterface
 * @package App\Services\Interfaces
 */
interface MainRepositoryInterface extends BaseRepositoryInterface
{
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 9,
        array $relations = []
    );
}
