<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Reponsitories\Interfaces\UserReponsitoryInterface as UserReponsitory;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userReponsitory;
    public function __construct(
        UserReponsitory $userReponsitory
    )
    {
        $this->userReponsitory = $userReponsitory;
    }
    public function paginate() {
        $users = $this->userReponsitory->getAllPaginate();
        return $users;
    }
}
