<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartResource\Pages;
use App\Models\Cart;
use App\Models\Product;  // Asegúrate de importar el modelo Product
use App\Models\User;     // Asegúrate de importar el modelo User
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Definir los campos en el formulario para crear/editar un carrito
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
                
                Forms\Components\Select::make('product_id')
                    ->label('Producto')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required(),
                
                Forms\Components\TextInput::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->required(),
            ]);
    }

    // Definir las columnas que aparecerán en la tabla de carritos
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Usuario'),
                Tables\Columns\TextColumn::make('product.name')->label('Producto'),
                Tables\Columns\TextColumn::make('quantity')->label('Cantidad'),
                Tables\Columns\TextColumn::make('price')->label('Precio')->money('USD'),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha de Creación')->dateTime(),
            ])
            ->filters([
                // Agregar filtros si es necesario
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

    // Definir las relaciones si las tienes (para mostrar relaciones en la tabla)
    public static function getRelations(): array
    {
        return [
            // Si tienes relaciones adicionales, puedes agregarlas aquí
        ];
    }

    // Definir las páginas para el recurso (index, create, edit)
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCart::route('/create'),
            'edit' => Pages\EditCart::route('/{record}/edit'),
        ];
    }
}
