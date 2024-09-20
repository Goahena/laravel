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
    )
    {
        $this->userReponsitory = $userReponsitory;
    }
    public function paginate() {
        $users = $this->userReponsitory->getAllPaginate();
        return $users;
    }
    public function create($request) {
        DB::beginTransaction();
        try{
            $payload = $request->except('_token', 're_password');
            $cacbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
            $payload['birthday'] = $cacbonDate->format('Y-m-d H:i:s');
            $payload['password'] = Hash::make($payload['password']);

            $user = $this->userReponsitory->create($payload);

            DB::commit();
            return true;
        }catch(Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}
