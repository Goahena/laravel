<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Reponsitories\Interfaces\UserCatalogueReponsitoryInterface as UserCatalogueReponsitory;
use App\Reponsitories\Interfaces\UserReponsitoryInterface as UserReponsitory;
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
    protected $userReponsitory;
    public function __construct(
        UserCatalogueReponsitory $userCatalogueReponsitory,
        UserReponsitory $userReponsitory
    ) {
        $this->userCatalogueReponsitory = $userCatalogueReponsitory;
        $this->userReponsitory = $userReponsitory;
    }
    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perPage = $request->integer('perpage') ? $request->integer('perpage') : 5;
        $userCatalogues = $this->userCatalogueReponsitory->pagination($this->selectPaginate(), $condition, [], ['path' => 'user/catalogue/index'], $perPage, ['users']);
        return $userCatalogues;
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
    public function destroy($id)
    {
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

    private function changeUserStatus($post, $value)
    {
        DB::beginTransaction();
        try {
            $array = [];
            if (isset($post['modelid'])) {
                $array[] = $post['modelid'];
            } else {
                $array = $post['id'];
            }
            $payload[$post['field']] = $value;
            $this->userReponsitory->updateByWhereIn('user_catalogue_id', $array, $payload);
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
            $payload[$post['field']] = (($post['value'] == 1) ? 0 : 1);
            $user = $this->userCatalogueReponsitory->update($post['modelid'], $payload);
            $this->changeUserStatus($post, $payload[$post['field']]);
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
            $flag = $this->userCatalogueReponsitory->updateByWhereIn('id', $post['id'], $payload);
            $this->changeUserStatus($post, $payload[$post['field']]);
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
