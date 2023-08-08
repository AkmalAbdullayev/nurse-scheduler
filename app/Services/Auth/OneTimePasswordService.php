<?php

namespace App\Services\Auth;

use App\Actions\Auth\GenerateOneTimePassword;
use App\Models\User;
use App\Models\VerificationCode;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class OneTimePasswordService
{
    public function __construct(
        private readonly GenerateOneTimePassword $otp
    )
    {

    }

    /**
     * @param Request $request
     * @param User $user
     * @return object
     * @throws Exception
     */
    public function store(Request $request, User $user): object
    {
        /**
         * @var VerificationCode $userOtp
         */

        $userOtp = VerificationCode::query()->where('user_id', '=', $user->id)->latest()->first();

        if ($userOtp && now()->isBefore($userOtp->expire_at)) {
            return $userOtp;
        }

        return VerificationCode::query()->create([
            'user_id' => $user->id,
            'otp' => $this->otp->generate(),
            'expire_at' => now()->addMinutes(10)
        ]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $userOtp = VerificationCode::query()
            ->where('user_id', '=', $request->input('user_id'))
            ->where('otp', '=', $request->input('otp'))
            ->latest()
            ->first();

        if (is_null($userOtp)) {
            return response()->json([
                'message' => 'Your OTP is not correct.'
            ], 422);
        }

        if ($userOtp && now()->isAfter($userOtp->expire_at)) {
            return response()->json([
                'message' => 'Your OTP has been expired'
            ], 422);
        }

        $user = User::query()->findOrFail($request->input('user_id'));

        if ($user) {
            $userOtp->update([
                'expire_at' => now()
            ]);

            Auth::login($user);

            if (\auth()->user()->roles->first()->name == 'Admin') {
                return response()->json([
                    'url' => '/admin'
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
            'url' => route('login'),
            'message' => 'Your OTP is not correct.'
        ]);
    }
}
