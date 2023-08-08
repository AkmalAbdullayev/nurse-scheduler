<?php

namespace App\helpers\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Twilio
{
    private Client $client;

    /**
     * @throws ConfigurationException
     */
    public function __construct()
    {
        // Instead of below code,
        // using Dependency Injection,
        // you can also bind Client to Service Container, because it contains constructor params.
        $this->client = new Client($this->getSid(), $this->getAuthToken());
    }

    /**
     * @return mixed
     */
    private function getSid(): mixed
    {
        return config('services.twilio.sid');
    }

    /**
     * @return mixed
     */
    private function getAuthToken(): mixed
    {
        return config('services.twilio.auth_token');
    }

    /**
     * @return mixed
     */
    private function getNumber(): mixed
    {
        return config('services.twilio.number');
    }

    /**
     * @return mixed
     */
    private function getNotifySid(): mixed
    {
        return config('services.twilio.notify_sid');
    }

    /**
     * @param string $cell_number
     * @param string $body
     * @return void
     */
    public function send(string $cell_number, string $body): void
    {
        try {
            $message = $this->client
                ->messages
                ->create($cell_number, [
                    'from' => $this->getNumber(),
                    'body' => $body
                ]);

            Log::channel('twilio')->info($message);
        } catch (TwilioException $exception) {
            Log::channel('twilio')->info($exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function bulk(array $data): void
    {
        try {
            $message = $this->client
                ->notify
                ->services($this->getNotifySid())
                ->notifications
                ->create($data);

            Log::channel('twilio')->info($message);
        } catch (TwilioException $exception) {
            Log::channel('twilio')->info($exception->getMessage());
        }
    }
}
