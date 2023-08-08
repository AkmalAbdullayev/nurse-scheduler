<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class ForgotPasswordController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('forgot');
    }

    /**
     * @throws ConfigurationException
     */
    public function forgotPasswordRequest(Request $request): RedirectResponse
    {
        $request->validate([
            'cell_number' => ['required', 'numeric']
        ]);

        $cellNumber = '+1' . $request->input('cell_number');

        $user = User::query()->where('cell_number', '=', $cellNumber)->exists();

        if ($user) {
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'cell_number' => $request->input('cell_number'),
                'token' => $token,
            ]);

            /* SMS Service Domain */
            $accountSid = config('services.twilio.sid');
            $accountAuthToken = config('services.twilio.auth_token');
            $accountNumber = config('services.twilio.number');

            $client = new Client($accountSid, $accountAuthToken);

            try {
                $message = $client->messages->create($request->input('cell_number'), [
                    'from' => $accountNumber,
                    'body' => "Reset link: " . route('forgot-password.reset-password') . '/' . $token . PHP_EOL . 'If you did not request a password reset, please contact your administrator.'
                ]);

                Log::channel('twilio')->info($message);
            } catch (TwilioException $exception) {
                Log::channel('twilio')->info($exception->getMessage());
            }

            return back()->with('message', 'Password Reset link is sent with SMS');
        }

        return back()->with('error', 'User not found.');
    }

    public function resetPasswordView(string $token): Factory|View|Application
    {
        $user = DB::table('password_resets')
            ->where('token', '=', $token)
            ->first();

        $cell_number = '+1' . $user->cell_number;

        $nurse = Nurse::query()
            ->where('cell_number', '=', $cell_number)
            ->firstOrFail();

        return view('reset', compact('nurse'));
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

//        $nurse = Nurse::query()
//            ->with('user')
//            ->where('cell_number', '=', $request->input('cell_number'))
//            ->first();

        $user = User::query()
            ->updateOrCreate([
                'cell_number' => $request->input('cell_number'),
            ], [
                'password' => Hash::make($request->input('password'))
            ]);

        if ($user) {
            DB::table('password_resets')
                ->where('cell_number', '=', $request->input('cell_number'))
                ->delete();
        }

        return redirect()->route('login')->with('message', 'Your password has been changed!');
    }
}
