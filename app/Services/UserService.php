<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\select;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->integer('perpage') ? $request->integer('perpage') : 5;
        $users = $this->userRepository->pagination(
            $this->selectPaginate(),
            $condition,
            [],
            ['path' => route('user.index')],
            $perPage
        );
                return $users;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 're_password');
            $phoneNumber = preg_replace('/[^0-9]/', '', $request->input('phone'));
            $payload['phone'] = $phoneNumber;
            if (isset($payload['birthday']) && !empty($payload['birthday'])) {
                $carbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
                $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
            }
            $payload['password'] = Hash::make($payload['password']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();

                $image->move(public_path('assets/images/avatar'), $imageName);
                $payload['image'] = 'assets/images/avatar/' . $imageName;
            }

            $user = $this->userRepository->create($payload);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    public function update($id, $updateRequest) 
    {
        DB::beginTransaction();
        try {
            $payload = $updateRequest->except('_token');
            $phoneNumber = preg_replace('/[^0-9]/', '', $updateRequest->input('phone'));
            $payload['phone'] = $phoneNumber;
            if (isset($payload['birthday']) && !empty($payload['birthday'])) {
                $carbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
                $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
            }
            if ($updateRequest->hasFile('image')) {
                $image = $updateRequest->file('image');
                $imageName = time() . '.' . $image->extension();
                
                $uploadPath = public_path('/assets/images/avatar');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true); // Tạo thư mục nếu chưa tồn tại
                }
            
                $image->move($uploadPath, $imageName);
                $payload['image'] = '/assets/images/avatar/' . $imageName;
            }
            
            
            $user = $this->userRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $user = $this->userRepository->destroy($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatus($post) {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2:1);
            $user = $this->userRepository->update($post['modelid'], $payload);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }

    public function updateStatusAll($post) {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $flag = $this->userRepository->updateByWhereIn('id', $post['id'], $payload);
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
            'user_catalogue_id',
            'publish',
            'image',
        ];
    }
}
