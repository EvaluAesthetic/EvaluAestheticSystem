<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientFormResource\Pages;
use App\Filament\Resources\ClientFormResource\RelationManagers;
use App\Models\ClientForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientFormResource extends Resource
{
    protected static ?string $model = ClientForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Klient Former';

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        $query = parent::getEloquentQuery();

        if($user->hasRole(2) && $user->professional) {
            $clinicId = $user->professional->clinic_id;
            $query->whereHas('client', function (Builder $query) use ($clinicId) {
                $query->where('clinic_id', $clinicId);
            });
        }
        if($user->hasRole(1)){
            return $query;
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('client_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('has_history')
                    ->required(),
                Forms\Components\Textarea::make('history')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('disease')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('has_disease')
                    ->required(),
                Forms\Components\Textarea::make('allergy')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('has_allergy')
                    ->required(),
                Forms\Components\Textarea::make('previous_treatments')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('had_previous_treatments')
                    ->required(),
                Forms\Components\Textarea::make('medication')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('has_medication')
                    ->required(),
                Forms\Components\TextInput::make('occupation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('video_path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('treatment_wishes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_history')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_disease')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_allergy')
                    ->boolean(),
                Tables\Columns\IconColumn::make('had_previous_treatments')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_medication')
                    ->boolean(),
                Tables\Columns\TextColumn::make('occupation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('video_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientForms::route('/'),
            'create' => Pages\CreateClientForm::route('/create'),
            'edit' => Pages\EditClientForm::route('/{record}/edit'),
        ];
    }
}
