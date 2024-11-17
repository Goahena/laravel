<?php

namespace App\Reponsitories;

use App\Reponsitories\Interfaces\LanguageReponsitoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class LanguageReponsitory extends BaseReponsitory implements LanguageReponsitoryInterface
{
    protected $model;
    public function __construct()
    {
    }
}
