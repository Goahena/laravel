<?php

namespace App\Repositories;

use App\Repositories\Interfaces\LanguageRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    protected $model;
    public function __construct()
    {
    }
}