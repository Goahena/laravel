<?php

namespace App\Services\Interfaces;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface BrandServiceInterface
{
    public function paginate($request);
    public function create($request);
    public function update($id, $updateRequest);
    public function destroy($id);
    public function updateStatus($post);

}
