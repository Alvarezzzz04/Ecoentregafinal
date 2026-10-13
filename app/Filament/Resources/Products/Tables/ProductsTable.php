<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('publication_date', 'desc')
            ->columns([
                ImageColumn::make('image_url')->label('Imagen'),
                TextColumn::make('product_name')->label('Producto')->searchable()->sortable(),
                TextColumn::make('category.category_name')->label('Categoría')->searchable()->sortable(),
                TextColumn::make('user.name')->label('Vendedor')->searchable()->sortable(),
                TextColumn::make('price')->label('Precio')->money('COP')->sortable(),
                TextColumn::make('stock')->label('Stock')->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 2 => 'warning',
                        default => 'success',
                    }),
                TextColumn::make('size')->label('Talla'),
                TextColumn::make('garment_condition')->label('Estado'),
                TextColumn::make('publication_date')->label('Publicado')->dateTime('d/m/Y')->sortable(),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
