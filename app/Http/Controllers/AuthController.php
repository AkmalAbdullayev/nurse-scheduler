<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'cell_number' => ['required'],
            'password' => ['required', 'min:6']
        ]);

        $credentials = $request->only('cell_number', 'password');
        $credentials['cell_number'] = '+1' . $credentials['cell_number'];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Auth::logoutOtherDevices($credentials['password']);

            if (\auth()->user()->roles->first()->name == 'Admin') {
                return response()->json([
                    'url' => route('main')
                ]);
            } else if (\auth()->user()->roles->first()->name == 'Perm School Nurse') {
                return response()->json([
                    'url' => route('school-nurse.call-out.index')
                ]);
            } else {
                return response()->json([
                    'url' => route('float-nurse.call-out.index')
                ]);
            }
        }

        return response()->json([
            'message' => 'User not found.'
        ], 422);
    }

    /**
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function registration(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate([
            'cell_number' => ['required'],
            'password' => ['required']
        ]);

        $user = User::query()->create([
            'cell_number' => $request->input('cell_number'),
            'password' => Hash::make($request->input('password'))
        ]);

        Nurse::query()
            ->where('cell_number', '=', $request->input('cell_number'))
            ->update(['user_id' => $user->id]);

        return redirect('/')->with('success', 'Successfully signed in');
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        Session::flush();

        Auth::logout();

        return redirect('/login');
    }
}
