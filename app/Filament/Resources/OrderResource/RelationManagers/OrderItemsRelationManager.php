<?php
namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager; 
use Filament\Tables;
use Filament\Forms;
use App\Models\OrderItem;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items'; 

    // Método para el formulario de relación
    public  function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('product_id')
                ->required()
                ->label('Product ID'),
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->label('Quantity'),
            Forms\Components\TextInput::make('price')
                ->required()
                ->label('Price'),
        ]);
    }

    // Método para la tabla de relación
    public  function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->label('ID'),
            Tables\Columns\TextColumn::make('product.name')->label('Product'),
            Tables\Columns\TextColumn::make('quantity')->label('Quantity'),
            Tables\Columns\TextColumn::make('price')->label('Price'),
        ]);
    }
}
