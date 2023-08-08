<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\OneTimePasswordService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class OtpController extends Controller
{
    /**
     * @param OneTimePasswordService $service
     */
    public function __construct(
        private readonly OneTimePasswordService $service
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ConfigurationException
     * @throws Exception
     */
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'cell_number' => ['required', 'string']
        ]);

        $cell_number = '+1' . $request->input('cell_number');

        $user = User::query()->where('cell_number', '=', $cell_number)->first();

        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found.'
            ], 422);
        }

        $verificationCode = $this->service->store($request, $user);

        $accountSid = config('services.twilio.sid');
        $accountAuthToken = config('services.twilio.auth_token');
        $accountNumber = config('services.twilio.number');

        $client = new Client($accountSid, $accountAuthToken);

        try {
            $message = $client->messages->create($user->cell_number, [
                'from' => $accountNumber,
                'body' => "Use this one time password to validate your login: " . $verificationCode->otp
            ]);

            Log::channel('twilio')->info($message);
        } catch (TwilioException $exception) {
            Log::channel('twilio')->info($exception->getMessage());
        }

        return response()->json([
            'url' => route('otp.verify', ['user_id' => $user->id]),
            'user_id' => $user->id
        ]);
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return Factory|View|Application
     */
    public function verify(Request $request, int $userId): Factory|View|Application
    {
        return view('auth.verify-otp', compact('userId'));
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'otp' => ['nullable', 'numeric']
        ]);

        return $this->service->login($request);
    }
}
