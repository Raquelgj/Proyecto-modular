<?php

namespace App\Filament\Resources;
use App\Filament\Resources\InvoiceResource\Pages\ViewInvoice;

use App\Models\Invoice;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\InvoiceResource\Pages;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $modelLabel = 'Factura';
    protected static ?string $pluralModelLabel = 'Facturas';
    protected static ?string $navigationLabel = 'Facturas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('invoice_number')->label('Número de Factura'),
                TextColumn::make('invoice_date')->date()->label('Fecha'),
                TextColumn::make('order.user.name')->label('Cliente'),
                TextColumn::make('order.total_price')->money('EUR')->label('Total'),
            ])
            ->actions([
                Action::make('Ver PDF')
                    ->url(fn (Invoice $record) => asset('storage/' . $record->pdf_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-arrow-down'),
            ]);
    }

 public static function getPages(): array
{
    return [
        'index' => Pages\ListInvoices::route('/'),
        'view' => ViewInvoice::route('/{record}'),
    ];
}
}
