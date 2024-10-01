<?php

namespace App\Listeners;

use Aws\Sns\SnsClient;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GenerateTwoFactorCode
{
    /**
     * Handle the event.
     *
     * @param  \Laravel\Fortify\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Generate a 6-digit verification code
        $verificationCode = random_int(100000, 999999);

        // Store the code in Redis cache for 5 minutes
        Cache::put('2fa_code_' . $user->id, $verificationCode, now()->addMinutes(5));

        $sns = new SnsClient([
            'region' => config('services.sns.region'),
            'version' => 'latest',
            'credentials' => [
                'key' => config('services.sns.key'),
                'secret' => config('services.sns.secret'),
            ],
        ]);

        $phoneNumber = '+45' . $user->phone;
        Log::info('Phone:' . $phoneNumber);

        try {
            $response = $sns->publish([
                'Message' => 'Your verification code is: ' . $verificationCode,
                'PhoneNumber' => $phoneNumber,
            ]);
            Log::info("Response" . $response);
        } catch (\Exception $e) {

            Log::error('Failed to send verification code via SMS: ' . $e->getMessage());
        }
    }
}
