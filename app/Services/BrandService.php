<?php

namespace App\Services;

use App\Services\Interfaces\BrandServiceInterface;
use App\Repositories\Interfaces\BrandRepositoryInterface as BrandRepository;
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
    protected $brandRepository;
    public function __construct(
        BrandRepository $brandRepository
    ) {
        $this->brandRepository = $brandRepository;
    }
    public function paginate($request)
{
    $condition = [
        'keyword' => addslashes($request->input('keyword'))
    ];
    $perPage = $request->input('perpage') ?: 10;

    return $this->brandRepository->pagination(
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

            $this->brandRepository->create($payload);

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

            $this->brandRepository->update($id, $payload);

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
            $Brand = $this->brandRepository->destroy($id);
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
            $Brand = $this->brandRepository->update($post['modelid'], $payload);
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
            $flag = $this->brandRepository->updateByWhereIn('id', $post['id'], $payload);
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
