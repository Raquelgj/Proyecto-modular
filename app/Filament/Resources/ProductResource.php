<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Category;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nombre'),
                Forms\Components\Textarea::make('description')->label('Descripción'),
                Forms\Components\TextInput::make('price')->required()->numeric()->label('Precio'),
                Forms\Components\TextInput::make('stock')->required()->numeric()->label('Stock'),
                Forms\Components\FileUpload::make('image')->image()->directory('products')->label('Imagen'),
                Forms\Components\Select::make('category_id')
                ->label('Categoría')
                ->relationship('category', 'name')
                ->required(),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('price')->label('Precio'),
                Tables\Columns\TextColumn::make('stock')->label('Stock'),
                Tables\Columns\ImageColumn::make('image')
                ->label('Imagen')
                ->url(fn($record) => (asset('storage/' . $record->image))) 
                ->width(80) 
                ->height(80)
            
            

            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoría')
                    ->relationship('category', 'name') // Relación con la categoría, usando 'name' como el campo que mostrarás
                    ->searchable(), // Opcional, para que puedas buscar entre las categorías
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


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
