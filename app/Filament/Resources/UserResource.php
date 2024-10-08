<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        $query = parent::getEloquentQuery();

        if ($user->hasRole(2) && $user->professional) {
            $clinicId = $user->professional->clinic_id;

            $query->where(function (Builder $query) use ($clinicId) {
                $query->whereHas('professional', function (Builder $query) use ($clinicId) {
                    $query->where('clinic_id', $clinicId);
                })
                    ->orWhereHas('clients', function (Builder $query) use ($clinicId) {
                        $query->where('clinic_id', $clinicId);
                    });
            })->distinct();
        }

        if ($user->hasRole(1)) {
            return $query;
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255)
                            ->label('Phone'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->label('Email'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->label('Password'),
                        Forms\Components\DatePicker::make('birthday')
                            ->label('Birthday'),
                    ]),
                Forms\Components\Hidden::make('email_verified_at'),
                Forms\Components\Hidden::make('approved_at'),
                Forms\Components\TextInput::make('current_team_id')
                    ->numeric()
                    ->default(null)
                    ->hidden(),
                Forms\Components\TextInput::make('profile_photo_path')
                    ->maxLength(2048)
                    ->default(null)
                    ->hidden(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Navn'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('E-mail'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Email bekræftelse')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Telefon Nummer'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('birthday')
                    ->label('Fødselsdag')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
//                SelectFilter::make('type')
//                    ->options([
//                        'workers' => 'Workers (Professionals)',
//                        'clients' => 'Clients',
//                    ])
//                    ->query(function (Builder $query, array $data) {
//                        if ($data['value'] === 'workers') {
//                            // Filter out professionals only
//                            $query->whereHas('professional')
//                                ->doesntHave('clients');
//                        } elseif ($data['value'] === 'clients') {
//                            // Retrieve users IDs for filtering clients only
//                            $userIds = User::whereHas('clients')
//                                ->whereDoesntHave('professional')
//                                ->pluck('id');
//
//                            $query->whereIn('id', $userIds);
//                        }
//                    })
//                    ->label('Filtre efter type'),
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
            RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
