<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseReponsitoryInterface
{
    public function all();
    public function create(array $payload = []);
    public function findById(int $modelId);
    public function update(int $id = 0, array $payload = []);
    public function destroy(int $id = 0);
    public function pagination(
        array $column = ['*'],
        array $condition = [],
        array $join = [],
        array $extend = [],
        int $perpage = 1

    );
}
