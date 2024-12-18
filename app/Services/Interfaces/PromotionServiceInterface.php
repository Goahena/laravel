<?php

namespace App\Services\Interfaces;

/**
 * Interface PromotionServiceInterface
 * @package App\Services\Interfaces
 */
interface PromotionServiceInterface
{
    public function paginate($request);
    public function create($request);
    public function update($id, $updateRequest);
    public function destroy($id);
    public function updateStatus($post);

}
