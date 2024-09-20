<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\UserReponsitoryInterface;
use App\Reponsitories\BaseReponsitory;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserReponsitory extends BaseReponsitory implements UserReponsitoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate() {
        return User::paginate(5);
    }
}
