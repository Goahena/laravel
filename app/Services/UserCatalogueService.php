<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Reponsitories\Interfaces\UserCatalogueReponsitoryInterface as UserCatalogueReponsitory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueReponsitory;
    public function __construct(
        UserCatalogueReponsitory $userCatalogueReponsitory
    ) {
        $this->userCatalogueReponsitory = $userCatalogueReponsitory;
    }
    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->integer('perpage') ? $request->integer('perpage') : 5;
        $users = $this->userCatalogueReponsitory->pagination($this->selectPaginate(), $condition, [], ['path' => 'user/catalogue/index'], $perPage);
        return $users;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');

            $user = $this->userCatalogueReponsitory->create($payload);

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

            $user = $this->userCatalogueReponsitory->update($id, $payload);
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
            $user = $this->userCatalogueReponsitory->destroy($id);
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
            $payload[$post['field']] = (($post['value'] == 1) ? 0 : 1);
            $user = $this->userCatalogueReponsitory->update($post['modelid'], $payload);
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
            $flag = $this->userCatalogueReponsitory->updateByWhereIn('id', $post['id'], $payload);
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
            'image',
            'publish',
            'description'
        ];
    }
}
