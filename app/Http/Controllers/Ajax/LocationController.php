<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use App\Reponsitories\Interfaces\DistrictReponsitoryInterface as DistrictReponsitory;

class LocationController extends Controller
{
    protected $districtReponsitory;
    public function __construct(
        DistrictReponsitory $districtReponsitory
    ) {
        $this->districtReponsitory = $districtReponsitory;
    }
    public function getLocation(Request $request) {
        $province_id = $request->input('province_id');
        $districts = $this->districtReponsitory->findDistrictByProvinceId($province_id);
        $response = [
            'html' => $this->renderHtml($districts)
        ];
        return response()->json($response);
    }
    public function renderHtml($districts) {
        $html = '<option value="0">[Chọn Quận/Huyện]</option>';
        foreach($districts as $district) {
            $html .='<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
}
