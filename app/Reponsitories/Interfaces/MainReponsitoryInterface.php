<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface MainServiceInterface
 * @package App\Services\Interfaces
 */
interface MainReponsitoryInterface extends BaseReponsitoryInterface
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
