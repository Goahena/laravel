<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }
    public function index() {
        $users = $this->userService->paginate();
        $template = 'backend.user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'users'
        ));
    }
}
