<?php

namespace App\Services;

use App\Services\Interfaces\ProductServiceInterface;
use App\Reponsitories\Interfaces\ProductReponsitoryInterface as ProductReponsitory;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\select;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    protected $productReponsitory;
    public function __construct(
        ProductReponsitory $productReponsitory
    ) {
        $this->productReponsitory = $productReponsitory;
    }
    public function paginate($request)
{
    $condition = [
        'keyword' => addslashes($request->input('keyword')),
        'shoeType' => $request->input('shoeType'),
        'brand' => $request->input('brand'),
        'promotion' => $request->input('promotion'),
    ];
    $perPage = $request->input('perpage') ?: 5;

    return $this->productReponsitory->pagination(
        ['product.*'], // Chỉ lấy các cột từ bảng products
        $condition,
        [], // Không cần join thêm ngoài các join mặc định
        ['path' => route('product.index')],
        $perPage
    );
}

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');

            // Tạo thư mục upload nếu chưa tồn tại
            $uploadPath = public_path('assets/images/product-image');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Xử lý từng hình ảnh
            for ($i = 1; $i <= 4; $i++) {
                $fieldName = "image_$i";
                if ($request->hasFile($fieldName)) {
                    $image = $request->file($fieldName);
                    $imageName = time() . "_$i." . $image->extension();
                    $image->move($uploadPath, $imageName);
                    $payload[$fieldName] = "assets/images/product-image/$imageName"; // Lưu đường dẫn vào payload
                }
            }

            // Thêm các thông tin khác từ request
            $payload['brand_id'] = $request->input('brand_id');
            $payload['shoe_type_id'] = $request->input('shoe_type_id');
            $payload['promotion_id'] = $request->input('promotion_id');

            // Tạo mới sản phẩm trong cơ sở dữ liệu
            $this->productReponsitory->create($payload);

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


            // Tạo thư mục upload nếu chưa tồn tại
            $uploadPath = public_path('assets/images/product-image');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Xử lý từng hình ảnh
            for ($i = 1; $i <= 4; $i++) {
                $fieldName = "image_$i";
                if ($updateRequest->hasFile($fieldName)) {
                    $image = $updateRequest->file($fieldName);
                    $imageName = time() . "_$i." . $image->extension();
                    $image->move($uploadPath, $imageName);
                    $payload[$fieldName] = "assets/images/product-image/$imageName"; // Lưu đường dẫn vào payload
                }
            }

            // Cập nhật thông tin sản phẩm
            $this->productReponsitory->update($id, $payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $Product = $this->productReponsitory->destroy($id);
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
            $Product = $this->productReponsitory->update($post['modelid'], $payload);
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
            $flag = $this->productReponsitory->updateByWhereIn('id', $post['id'], $payload);
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
            'name',
            'email',
            'phone',
            'Product_catalogue_id',
            'publish',
            'image',
        ];
    }
}
