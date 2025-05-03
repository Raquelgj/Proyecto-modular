<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use App\Filament\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;

class ViewOrder extends ViewRecord
{
    protected static string $resource = \App\Filament\Resources\OrderResource::class;

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    // Cambiar protected a public
    public function getRelationManagers(): array
    {
        return [
            OrderItemsRelationManager::class,  
        ];
    }
}
