<?php
namespace App\Filament\Resources;

use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\CategoryResource\Pages;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationLabel = 'Categorías'; // Nombre que aparecerá en la barra lateral
    protected static ?string $navigationGroup = 'Productos'; // Agrupado bajo 'Productos' en la barra lateral

    // Método para el formulario de creación/edición
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name') // Campo para el nombre de la categoría
                    ->required()
                    ->label('Nombre de la Categoría'),
            ]);
    }

    // Método para la tabla de visualización de categorías
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name') // Muestra el nombre de la categoría
                    ->sortable()
                    ->searchable()
                    ->label('Nombre'),
            ])
            ->filters([]) // Si necesitas filtros, los puedes agregar aquí
            ->actions([ // Definir acciones como editar
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([ // Acciones masivas, como eliminar
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Método para registrar las rutas de las páginas de este recurso
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
