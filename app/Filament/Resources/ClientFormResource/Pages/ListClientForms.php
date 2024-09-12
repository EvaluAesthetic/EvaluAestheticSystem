<?php

namespace App\Filament\Resources\ClientFormResource\Pages;

use App\Filament\Resources\ClientFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientForms extends ListRecords
{
    protected static string $resource = ClientFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
