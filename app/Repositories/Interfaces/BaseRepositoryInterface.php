<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
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
        int $perpage = 5,
        array $relations = []
    );
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload);
}
