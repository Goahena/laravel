<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\UserReponsitoryInterface;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserReponsitory implements UserReponsitoryInterface
{
    public function getAllPaginate() {
        return User::paginate(5);
    }
}
