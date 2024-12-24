<?php

namespace App\Services;

use App\Services\Interfaces\ShoeTypeServiceInterface;
use App\Repositories\Interfaces\ShoeTypeRepositoryInterface as ShoeTypeRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * Class ShoeTypeService
 * @package App\Services
 */
class ShoeTypeService implements ShoeTypeServiceInterface
{
    protected $shoeTypeRepository;
    public function __construct(
        ShoeTypeRepository $shoeTypeRepository
    ) {
        $this->shoeTypeRepository = $shoeTypeRepository;
    }
    public function paginate($request)
{
    $condition = [
        'keyword' => addslashes($request->input('keyword'))
    ];
    $perPage = $request->input('perpage') ?: 10;

    return $this->shoeTypeRepository->pagination(
        ['shoe_types.*'], // Chỉ lấy các cột từ bảng shoeTypess
        $condition,
        [], // Không cần join thêm ngoài các join mặc định
        ['path' => route('shoe-type.index')],
        $perPage
    );
}

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');

            $this->shoeTypeRepository->create($payload);

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

            // Cập nhật thông tin sản phẩm
            $this->shoeTypeRepository->update($id, $payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating shoe type: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $ShoeType = $this->shoeTypeRepository->destroy($id);
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
            $ShoeType = $this->shoeTypeRepository->update($post['modelid'], $payload);
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
            $flag = $this->shoeTypeRepository->updateByWhereIn('id', $post['id'], $payload);
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
            'shoe_type_name',
            'created_at',
            'updated_at'
        ];
    }
}
