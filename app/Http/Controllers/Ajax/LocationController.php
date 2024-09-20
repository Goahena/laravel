<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use App\Reponsitories\Interfaces\DistrictReponsitoryInterface as DistrictReponsitory;
use App\Reponsitories\Interfaces\ProvinceReponsitoryInterface as ProvinceReponsitory;

class LocationController extends Controller
{
    protected $districtReponsitory;
    protected $provinceReponsitory;
    public function __construct(
        DistrictReponsitory $districtReponsitory,
        ProvinceReponsitory $provinceReponsitory
    ) {
        $this->districtReponsitory = $districtReponsitory;
        $this->provinceReponsitory = $provinceReponsitory;
    }
    public function getLocation(Request $request) {
        $get = $request->input();
        $html = '';
        if($get['target'] == 'districts'){
            $province = $this->provinceReponsitory->findById($get['data']['location_id'], ['code', 'name'], ['districts']);
            $html = $this->renderHtml($province->districts);
        }else if($get['target'] == 'wards'){
            $district = $this->districtReponsitory->findById($get['data']['location_id'], ['code', 'name'], ['wards']);
            $html = $this->renderHtml($district->wards, '[Chọn Phường/Xã]');
        }
        $response = [
            'html'=>$html
        ];
        return response()->json($response);
    }
    public function renderHtml($districts, $root = '[Chọn Quận/Huyện]') {
        $html = '<option value="0">'.$root.'</option>';
        foreach($districts as $district) {
            $html .='<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
}
