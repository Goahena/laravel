<?php

namespace App\Services;

use App\Services\Interfaces\MainServiceInterface;
use App\Reponsitories\Interfaces\MainReponsitoryInterface as MainReponsitory;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MainService implements MainServiceInterface
{
    protected $mainReponsitory;

    public function __construct(MainReponsitory $mainReponsitory)
    {
        $this->mainReponsitory = $mainReponsitory;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->integer('perpage') ? $request->integer('perpage') : 9;

        $products = $this->mainReponsitory->pagination(
            $this->selectPaginate(),
            $condition,
            [],
            ['path' => 'store'],
            $perPage,
            ['shoeType', 'brand', 'promotions']
        );

        return $products;
    }

    private function selectPaginate()
    {
        return [
            'product.id',
            'product.name',
            'product.shoe_type_id',
            'product.brand_id',
            'product.description',
            'product.price',
            'product.quantity',
            'product.image_1',
            'product.image_2',
            'product.image_3',
            'product.image_4',
            'product.promotion_id',
            'product.purchase_quantity',
        ];
    }
}
