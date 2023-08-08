<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function login(): Factory|View|Application
    {
        return view('auth.mobile.login');
    }
}
