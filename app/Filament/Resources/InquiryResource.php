<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InquiryResource\Pages;
use App\Filament\Resources\InquiryResource\RelationManagers;
use App\Models\Inquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

   protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
     protected static ?string $modelLabel = 'Consultas';
    protected static ?string $pluralModelLabel = 'Consultas';
    protected static ?string $navigationLabel = 'Consultas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->label('Nombre'),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('message')->label('Mensaje')->limit(50),
            TextColumn::make('created_at')->label('Enviado el')->dateTime(),
        ])
        ->filters([
            //
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
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
