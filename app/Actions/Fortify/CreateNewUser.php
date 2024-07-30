<?php

namespace App\Actions\Fortify;

use App\Models\Professional;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        Log::debug('An informational message.', $input);
        $user = User::where('registration_token', $input['token'])->firstOrFail();
        $user->create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);

        if ($input['role_id'] === "3") {
            Professional::create([
                'user_id' => $user->id,
                'clinic_id' => $input['clinic_id'],
            ]);
            $user->roles()->attach($input['role_id']);
        } else if ($input['role_id'] === "4") {
            $user->roles()->attach($input['role_id']);
        }

        return $user;
    }
}
