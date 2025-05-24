<?php

namespace App\Filament\Resources;

use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Resources\OrderResource\Pages\ViewOrder;  
use App\Filament\Resources\OrderResource\Pages\EditOrder;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
     protected static ?string $modelLabel = 'Pedidos';
    protected static ?string $pluralModelLabel = 'Pedidos';
    protected static ?string $navigationLabel = 'Pedidos';
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
        Tables\Columns\TextColumn::make('address')->label('Dirección')->limit(30),
        Tables\Columns\TextColumn::make('city')->label('Ciudad'),
        Tables\Columns\TextColumn::make('postal_code')->label('Código Postal'),
        Tables\Columns\TextColumn::make('country')->label('País'),
        Tables\Columns\TextColumn::make('payment_method')->label('Método de Pago'),
    ])
     ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(), 
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
        'view' => ViewOrder::route('/{record}'),
        'edit' => EditOrder::route('/{record}/edit'),  // Añade esta línea
    ];
}
}
