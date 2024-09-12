<?php

namespace App\Filament\Resources\ClientFormResource\Pages;

use App\Filament\Resources\ClientFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientForm extends EditRecord
{
    protected static string $resource = ClientFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
