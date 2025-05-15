<?php

namespace App\Filament\Resources;

use App\Enums\TransactionPaymentStatus;
use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\CarService;
use App\Models\CarStore;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?string $navigationGroup = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255)
                    ->readOnly()
                    ->default('BK' . date('ymd') . rand(000, 999)),
                Section::make('Customer Information')
                    ->description('Information about the customer')
                    ->columns(2)
                    ->icon('heroicon-m-user')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ]),
                Section::make('Service Information')
                    ->description('Information about the car service')
                    ->columns(2)
                    ->icon('heroicon-m-wrench')
                    ->schema([
                        Forms\Components\Select::make('car_store_id')
                            ->required()
                            ->live()
                            ->options(CarStore::query()->pluck('name', 'id'))
                            ->preload()
                            ->searchable()
                            ->afterStateUpdated(function (Set $set) {
                                $set('car_service_id', null);
                                $set('price', 0);
                                $set('vat', 0);
                                $set('grand_total', 0);
                            })
                            ->label('Car Store'),
                        Forms\Components\Select::make('car_service_id')
                            ->required()
                            ->live()
                            ->searchable()
                            ->placeholder(fn(Get $get) => empty($get('car_store_id')) ? 'First select a car store' : 'Select a service')
                            ->options(function (Get $get) {
                                return CarStore::with(['carServices'])->where('id', $get('car_store_id'))->get()->pluck('carServices')->flatten()->pluck('name', 'id');
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                $carService = CarService::query()->find($state);

                                $price = $carService->price;
                                $bookingFee = 50000;
                                $vat = 0.11 * ($price + $bookingFee);
                                $grandTotal = $price + $bookingFee + $vat;

                                $set('price', $carService->price);
                                $set('vat', $vat);
                                $set('grand_total', $grandTotal);
                            })
                            ->label('Car Service'),
                        Forms\Components\DatePicker::make('started_date')
                            ->required()
                            ->label('Started Date'),
                        Forms\Components\TimePicker::make('started_time')
                            ->required()
                            ->label('Started Time'),
                    ]),
                Section::make('Payment')
                    ->description('Information about the payment')
                    ->columns(2)
                    ->icon('heroicon-m-credit-card')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('IDR')
                            ->readOnly(),
                        Forms\Components\TextInput::make('booking_fee')
                            ->required()
                            ->numeric()
                            ->default(50000)
                            ->label('Booking Fee')
                            ->readOnly()
                            ->prefix('IDR'),
                        Forms\Components\TextInput::make('vat')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('VAT (11%)')
                            ->readOnly()
                            ->prefix('IDR'),
                        Forms\Components\TextInput::make('grand_total')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('Grand Total')
                            ->readOnly()
                            ->prefix('IDR'),
                        Forms\Components\Select::make('payment_status')
                            ->required()
                            ->enum(TransactionPaymentStatus::class)
                            ->options(TransactionPaymentStatus::class)
                            ->default(TransactionPaymentStatus::PENDING),
                        Forms\Components\FileUpload::make('payment_proof')
                            ->image()
                            ->directory('bookings/payment-proof')
                            ->label('Payment Proof'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i:s')
                    ->sortable()
                    ->label('Transaction Date'),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->label('Code'),
                Tables\Columns\TextColumn::make('name')
                    ->description(fn(Booking $record) => $record->phone)
                    ->searchable(),
                Tables\Columns\TextColumn::make('carStore.name')
                    ->description(fn(Booking $record) => $record->carService->name)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('started_date')
                    ->date()
                    ->description(fn(Booking $record) => $record->started_time)
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grand_total')
                    ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                    ->sortable()
                    ->prefix('IDR ')
                    ->label('Grand Total'),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn($state) => $state->getColor())
                    ->label('Payment Status'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make()->color('primary'),
                        Tables\Actions\EditAction::make()->color('warning'),
                    ])->dropdown(false),
                    Tables\Actions\DeleteAction::make()
                ])
                    ->icon('heroicon-m-bars-3')
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
