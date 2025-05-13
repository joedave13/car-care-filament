<?php

namespace App\Filament\Resources\CarStoreResource\Pages;

use App\Filament\Resources\CarStoreResource;
use App\Models\CarStore;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewCarStore extends ViewRecord
{
    protected static string $resource = CarStoreResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Grid::make(3)
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('slug'),
                    TextEntry::make('city.name'),
                ]),
            TextEntry::make('address'),
            TextEntry::make('about'),
            Grid::make(3)
                ->schema([
                    TextEntry::make('customer_service_name')
                        ->label('Customer Service Name'),
                    TextEntry::make('customer_service_phone')
                        ->label('Customer Service Phone'),
                    ImageEntry::make('customer_service_avatar')
                        ->label('Customer Service Avatar')
                        ->circular()
                        ->size(60),
                ]),
            IconEntry::make('is_open')
                ->boolean()
                ->label('Is Open?'),
            IconEntry::make('is_full')
                ->boolean()
                ->label('Is Full?'),
        ]);
    }
}
