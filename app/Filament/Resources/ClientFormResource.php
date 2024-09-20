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
                Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Section::make('Historik')
                        ->description('Har klienten en historik?')
                        ->schema([
                            Forms\Components\Toggle::make('has_history')
                                ->label('Historik')
                                ->reactive()
                                ->required()
                                ->onColor('success')
                                ->offColor('danger'),
                            Forms\Components\Textarea::make('history')
                                ->visible(fn($get) => $get('has_history'))
                                ->placeholder('Indtast klientens historik'),
                        ]),
                    Forms\Components\Section::make('Graviditet eller amning')
                        ->description('Er klienten gravid eller ammer klienten?')
                        ->schema([
                            Forms\Components\Toggle::make('is_pregnant_or_breastfeeding')
                                ->label('Graviditet eller amning')
                                ->reactive()
                                ->required()
                                ->onColor('success')
                                ->offColor('danger'),
                            Forms\Components\Textarea::make('pregnancy_details')
                                ->visible(fn($get) => $get('is_pregnant_or_breastfeeding')) // Show only if has_disease is true
                                ->placeholder('Indtast detaljer om klientens amning eller graviditet'),
                        ]),
                    Forms\Components\Section::make('Allergier')
                        ->description('Har klienten nogle allergier?')
                        ->schema([
                            Forms\Components\Toggle::make('has_allergy')
                                ->label('Allergier')
                                ->reactive()
                                ->required()
                                ->onColor('success')
                                ->offColor('danger'),
                            Forms\Components\Textarea::make('allergy')
                                ->visible(fn($get) => $get('has_allergy')) // Show only if has_allergy is true
                                ->placeholder('Indtast klientens allergier'),
                        ]),

                    Forms\Components\Section::make('Tidligere indgreb')
                        ->description('Har klienten fået foretaget nogle tidligere indgreb?')
                        ->schema([
                            Forms\Components\Toggle::make('had_previous_treatments')
                                ->label('Tidligere indgreb')
                                ->reactive()
                                ->required()
                                ->onColor('success')
                                ->offColor('danger'),
                            Forms\Components\Textarea::make('previous_treatments')
                                ->visible(fn($get) => $get('had_previous_treatments')) // Show only if had_previous_treatments is true
                                ->placeholder('Indtast klientens tidligere indgreb'),
                        ]),

                    Forms\Components\Section::make('Medicin')
                        ->description('Er klienten på noget medicin?')
                        ->schema([
                            Forms\Components\Toggle::make('has_medication')
                                ->label('Medicin')
                                ->reactive()
                                ->required()
                                ->onColor('success')
                                ->offColor('danger'),
                            Forms\Components\Textarea::make('medication')
                                ->visible(fn($get) => $get('has_medication')) // Show only if has_medication is true
                                ->placeholder('Indtast klientens medicin'),
                        ]),
                    Forms\Components\Section::make('Video')
                        ->description('Her er klientens video hvor der kan uploades en ny hvis det er nødvendigt')
                        ->schema([
                            Forms\Components\FileUpload::make('video_path')
                                ->disk('s3')
                                ->directory('videos')
                                ->visibility('private')
                        ]),
                    Forms\Components\Section::make('Ønskede behandling')
                        ->description('Her beskriver klienten hvilken behandling de ønsker')
                        ->schema([
                            Forms\Components\Textarea::make('treatment_wishes')
                                ->label('Beskrivelse')
                                ->columnSpanFull(),
                            ]),
                ]),
                Forms\Components\TextInput::make('occupation')
                    ->label('Beskæftigelse')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.user.name')
                    ->label('Navn')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_history')
                    ->label('Historik')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_pregnant_or_breastfeeding')
                    ->label('Graviditet eller amning')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_allergy')
                    ->label('Allergier')
                    ->boolean(),
                Tables\Columns\IconColumn::make('had_previous_treatments')
                    ->label('Tidligere indgreb')
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_medication')
                    ->label('Medicin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('occupation')
                    ->label('Beskæftigelse')
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
