<?php

namespace App\Reponsitories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserReponsitoryInterface extends BaseReponsitoryInterface
{
    public function getAllPaginate();
}
