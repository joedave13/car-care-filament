<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Booking;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;
use Illuminate\Support\Facades\Storage;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('created_at')->label('Transaction Date'),
            TextEntry::make('code'),
            Section::make('Customer Information')
                ->description('Information about the customer')
                ->icon('heroicon-m-user')
                ->columns(2)
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('phone'),
                ]),
            Section::make('Service Information')
                ->description('Information about the car service')
                ->icon('heroicon-m-wrench')
                ->columns(2)
                ->schema([
                    TextEntry::make('carStore.name')->label('Car Store'),
                    TextEntry::make('carService.name')->label('Car Service'),
                    TextEntry::make('started_date'),
                    TextEntry::make('started_time'),
                ]),
            Section::make('Payment')
                ->description('Information about the payment')
                ->icon('heroicon-m-credit-card')
                ->columns(2)
                ->schema([
                    TextEntry::make('price')
                        ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                        ->prefix('IDR '),
                    TextEntry::make('booking_fee')
                        ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                        ->prefix('IDR '),
                    TextEntry::make('vat')
                        ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                        ->prefix('IDR '),
                    TextEntry::make('grand_total')
                        ->numeric(decimalPlaces: 0, thousandsSeparator: '.')
                        ->prefix('IDR '),
                    TextEntry::make('payment_status')
                        ->badge()
                        ->color(fn($state) => $state->getColor()),
                    TextEntry::make('payment_proof')
                        ->label('Payment Proof')
                        ->url(fn(Booking $record) => $record->payment_proof ? Storage::url($record->payment_proof) : 'javascript:void(0)')
                        ->openUrlInNewTab(fn(Booking $record) => $record->payment_proof !== null)
                        ->state(fn(Booking $record) => $record->payment_proof ? 'Open Payment Proof' : 'Payment Proof Not Available')
                        ->icon(fn(Booking $record) => $record->payment_proof ? 'heroicon-m-arrow-top-right-on-square' : 'heroicon-m-x-mark')
                        ->iconColor(fn(Booking $record) => $record->payment_proof ? 'primary' : 'danger')
                        ->iconPosition(IconPosition::After)
                        ->color(fn(Booking $record) => $record->payment_proof ? 'primary' : 'danger')
                        ->weight(FontWeight::Bold)
                ]),
        ]);
    }
}
