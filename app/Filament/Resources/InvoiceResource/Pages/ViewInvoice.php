<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getViewFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('invoice_number')->disabled(),
            Forms\Components\DatePicker::make('invoice_date')->disabled(),
            Forms\Components\TextInput::make('order.user.name')->label('Cliente')->disabled(),
            Forms\Components\TextInput::make('order.total_price')->label('Total')->disabled(),

        ];
    }
}
