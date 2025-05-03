<?php

namespace App\Filament\Resources;

use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Resources\OrderResource\Pages\ViewOrder;  // Corregido

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    public static function query(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::query()
            ->with('items.product'); // Asegúrate de cargar la relación 'product' dentro de 'items'
    }
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pendiente',
                    'completed' => 'Completado',
                    'cancelled' => 'Cancelado',
                ])
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->label('ID'),
            Tables\Columns\TextColumn::make('user.name')->label('Cliente'),
            Tables\Columns\TextColumn::make('total_price')->money('EUR'),
            Tables\Columns\TextColumn::make('status')->badge(),
            // Mostrar el nombre del producto asociado con cada orden
            Tables\Columns\TextColumn::make('items.product.name')->label('Product'), // Esto debería funcionar si la relación 'items' está bien definida
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
        ]);
    }
    

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrder::route('/{record}'),  // Corrección aquí también
        ];
    }
}
