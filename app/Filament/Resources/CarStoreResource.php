<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarStoreResource\Pages;
use App\Filament\Resources\CarStoreResource\RelationManagers;
use App\Models\CarStore;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CarStoreResource extends Resource
{
    protected static ?string $model = CarStore::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('city:id,name');
    }

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
                        Forms\Components\Select::make('city_id')
                            ->relationship('city', 'name')
                            ->required()
                            ->preload()
                            ->searchable(),
                    ]),
                Forms\Components\Textarea::make('address')
                    ->rows(5),
                Forms\Components\Textarea::make('about')
                    ->rows(5),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('customer_service_name')
                            ->maxLength(255)
                            ->label('Customer Service Name'),
                        Forms\Components\TextInput::make('customer_service_phone')
                            ->tel()
                            ->maxLength(255)
                            ->label('Customer Service Phone'),
                        Forms\Components\FileUpload::make('customer_service_avatar')
                            ->image()
                            ->directory('car-stores/customer-service-avatar')
                            ->label('Customer Service Avatar'),
                    ]),
                Forms\Components\Toggle::make('is_open')
                    ->required()
                    ->label('Is Open?')
                    ->default(true)
                    ->inline(false),
                Forms\Components\Toggle::make('is_full')
                    ->required()
                    ->label('Is Full?')
                    ->default(false)
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(fn(CarStore $record) => $record->city->name)
                    ->searchable(),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('about')
                    ->wrap()
                    ->lineClamp(2),
                Tables\Columns\IconColumn::make('is_open')
                    ->boolean()
                    ->label('Is Open?')
                    ->action(function (CarStore $record) {
                        $record->is_open = !$record->is_open;
                        $record->save();
                    }),
                Tables\Columns\IconColumn::make('is_full')
                    ->boolean()
                    ->label('Is Full?')
                    ->action(function (CarStore $record) {
                        $record->is_full = !$record->is_full;
                        $record->save();
                    }),
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
            'index' => Pages\ListCarStores::route('/'),
            'create' => Pages\CreateCarStore::route('/create'),
            'edit' => Pages\EditCarStore::route('/{record}/edit'),
        ];
    }
}
