<?php

namespace App\Repositories;

use App\Repositories\Interfaces\WardRepositoryInterface;
use App\Models\Ward;

/**
 * Class UserService
 * @package App\Services
 */
class WardRepository extends BaseRepository implements WardRepositoryInterface
{
    protected $model;
    public function __construct(Ward $model)
    {
        $this->model = $model;
    }
}
