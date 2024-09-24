<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Reponsitories\Interfaces\UserReponsitoryInterface as UserReponsitory;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userReponsitory;
    public function __construct(
        UserReponsitory $userReponsitory
    ) {
        $this->userReponsitory = $userReponsitory;
    }
    public function paginate()
    {
        $users = $this->userReponsitory->getAllPaginate();
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

            $user = $this->userReponsitory->create($payload);

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

                $image->move(public_path('assets/images/avatar'), $imageName);
                $payload['image'] = 'assets/images/avatar/' . $imageName;
            }
            $user = $this->userReponsitory->update($id, $payload);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
    }
}
