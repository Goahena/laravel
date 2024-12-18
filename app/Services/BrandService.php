<?php

namespace App\Services;

use App\Services\Interfaces\BrandServiceInterface;
use App\Reponsitories\Interfaces\BrandReponsitoryInterface as BrandReponsitory;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class BrandService
 * @package App\Services
 */
class BrandService implements BrandServiceInterface
{
    protected $brandReponsitory;
    public function __construct(
        BrandReponsitory $brandReponsitory
    ) {
        $this->brandReponsitory = $brandReponsitory;
    }
    public function paginate($request)
{
    $condition = [
        'keyword' => addslashes($request->input('keyword'))
    ];
    $perPage = $request->input('perpage') ?: 10;

    return $this->brandReponsitory->pagination(
        ['brands.*'], // Chỉ lấy các cột từ bảng brands
        $condition,
        [], // Không cần join thêm ngoài các join mặc định
        ['path' => route('brand.index')],
        $perPage
    );
}

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');

            $this->brandReponsitory->create($payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());
            return false;
        }
    }


    public function update($id, $updateRequest)
    {
        DB::beginTransaction();
        try {
            $payload = $updateRequest->except('_token');

            $this->brandReponsitory->update($id, $payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating brand: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $Brand = $this->brandReponsitory->destroy($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatus($post)
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
            $Brand = $this->brandReponsitory->update($post['modelid'], $payload);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($post)
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $flag = $this->brandReponsitory->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    private function selectPaginate()
    {
        return [
            'id',
            'brand_name',
            'created_at',
            'updated_at'
        ];
    }
}
