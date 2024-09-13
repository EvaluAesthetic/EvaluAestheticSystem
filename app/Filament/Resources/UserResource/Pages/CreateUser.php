<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Professional;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set the timestamps before creating the user record
        $data['email_verified_at'] = Carbon::now();
        $data['approved_at'] = Carbon::now();

        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Create the user record using Filament's default behavior
        $user = parent::handleRecordCreation($data);

        // Get the clinic_id of the currently authenticated user's professional
        $clinicId = auth()->user()->professional->clinic_id;

        // Insert role assignment into the role_user table
        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => $user->id,
        ]);

        // Create the Professional object associated with the user and clinic
        Professional::create([
            'clinic_id' => $clinicId,
            'user_id' => $user->id,
        ]);

        return $user;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
