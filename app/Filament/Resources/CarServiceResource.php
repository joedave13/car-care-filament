<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarServiceResource\Pages;
use App\Filament\Resources\CarServiceResource\RelationManagers;
use App\Models\CarService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CarServiceResource extends Resource
{
    protected static ?string $model = CarService::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state) . '-' . strtolower(Str::random(5)))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->readOnly(),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),
                    ]),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(5),
                Forms\Components\FileUpload::make('icon')
                    ->image()
                    ->directory('car-services/icon'),
                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->directory('car-services/photo'),
                Forms\Components\TextInput::make('duration_in_hour')
                    ->required()
                    ->numeric()
                    ->label('Duration in Hour'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                    ->prefix('IDR ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_in_hour')
                    ->numeric()
                    ->sortable()
                    ->label('Duration in Hour')
                    ->suffix(' Hour'),
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
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCarServices::route('/'),
            'create' => Pages\CreateCarService::route('/create'),
            'edit' => Pages\EditCarService::route('/{record}/edit'),
        ];
    }
}
