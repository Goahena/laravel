<?php

namespace App\Services;

use App\Services\Interfaces\PromotionServiceInterface;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\select;

/**
 * Class PromotionService
 * @package App\Services
 */
class PromotionService implements PromotionServiceInterface
{
    protected $promotionRepository;
    public function __construct(
        PromotionRepository $promotionRepository
    ) {
        $this->promotionRepository = $promotionRepository;
    }
    public function paginate($request)
{
    $condition = [
        'keyword' => addslashes($request->input('keyword'))
    ];
    $perPage = $request->input('perpage') ?: 10;

    return $this->promotionRepository->pagination(
        ['promotions.*'], // Chỉ lấy các cột từ bảng promotions
        $condition,
        [], // Không cần join thêm ngoài các join mặc định
        ['path' => route('promotion.index')],
        $perPage
    );
}

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');

            // Tạo mới sản phẩm trong cơ sở dữ liệu
            $this->promotionRepository->create($payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating promotion: ' . $e->getMessage());
            return false;
        }
    }


    public function update($id, $updateRequest)
    {
        DB::beginTransaction();
        try {
            $payload = $updateRequest->except('_token');

            // Cập nhật thông tin sản phẩm
            $this->promotionRepository->update($id, $payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating promotion: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $Promotion = $this->promotionRepository->destroy($id);
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
            $Promotion = $this->promotionRepository->update($post['modelid'], $payload);
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
            $flag = $this->promotionRepository->updateByWhereIn('id', $post['id'], $payload);
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
            'promotion_name',
            'created_at',
            'updated_at'
        ];
    }
}
