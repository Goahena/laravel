<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Reponsitories\Interfaces\LanguageReponsitoryInterface as LanguageReponsitory;
use App\Http\Requests\StoreLanguageRequest;

class LanguageController extends Controller
{
    protected $LanguageReponsitory;
    protected $LanguageService;
    public function __construct(
        LanguageReponsitory $LanguageReponsitory,
        LanguageService $LanguageService,
    ) {
        $this->LanguageService = $LanguageService;
        $this->LanguageReponsitory = $LanguageReponsitory;
    }
    public function index(Request $request)
    {
        // $Languages = $this->LanguageService->paginate($request);
        return view('backend.dashboard.layout');
    }
    // public function store(StoreLanguageRequest $request)
    // {
    //     if ($this->LanguageService->create($request)) {
    //         return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới thành thành công');
    //     }
    //     return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới không thành công, hãy thử lại');
    // }
    // public function create()
    // {
    //     return view('backend.dashboard.layout');
    // }
//     public function update($id, StoreLanguageRequest $updateRequest) {
//         if ($this->LanguageService->update($id, $updateRequest)) {
//             return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật thành thành công');
//         }
//         return redirect()->route('user.catalogue.index')->with('error', 'Cập nhật không thành công, hãy thử lại');
//     }
//     public function edit($id)
//     {
//         $Language = $this->LanguageReponsitory->findById($id);
//         $config['seo'] = config('apps.Language');
//         $config['method'] = 'edit';
//         $template = 'backend.user.catalogue.store';
//         return view('backend.dashboard.layout', compact(
//             'template',
//             'config',
//             'Language',
//         ));
//     }
//     public function delete($id)
//     {
//         $config['seo'] = config('apps.Language');
//         $Language = $this->LanguageReponsitory->findById($id);
//         $template = 'backend.user.catalogue.delete';
//         return view('backend.dashboard.layout', compact(
//             'template',
//             'Language',
//             'config'
//         ));
//     }
//     public function destroy($id) {
//         if ($this->LanguageService->destroy($id)) {
//             return redirect()->route('user.catalogue.index')->with('success', 'Xóa thành thành công');
//         }
//         return redirect()->route('user.catalogue.index')->with('error', 'Xóa không thành công, hãy thử lại');
//     }
}
