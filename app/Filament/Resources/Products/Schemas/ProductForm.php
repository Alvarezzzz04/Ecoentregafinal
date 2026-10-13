<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use App\Models\User;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_name')
                    ->label('Nombre del producto')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0)
                    ->required(),
                TextInput::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->minValue(0)
                    ->default(1)
                    ->required(),
                Select::make('size')
                    ->label('Talla')
                    ->options(function (Get $get): array {
                        $categoryName = \App\Models\Category::query()
                            ->whereKey($get('id_category'))
                            ->value('category_name');

                        if ($categoryName === 'Zapatos') {
                            return array_combine(range(35, 45), range(35, 45));
                        }

                        if ($categoryName === 'Pantalones') {
                            $sizes = range(28, 44, 2);
                            return array_combine($sizes, $sizes);
                        }

                        if ($categoryName === 'Accesorios') {
                            return ['Única' => 'Única'];
                        }

                        return ['XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL'];
                    })
                    ->required(),
                Select::make('garment_condition')
                    ->label('Estado de la prenda')
                    ->options(['Nueva' => 'Nueva', 'Como nueva' => 'Como nueva', 'Buen estado' => 'Buen estado', 'Usada' => 'Usada'])
                    ->required(),
                TextInput::make('color')
                    ->label('Color')
                    ->required()
                    ->maxLength(100),
                Select::make('id_category')
                    ->label('Categoría')
                    ->relationship('category', 'category_name')
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('id_user')
                    ->label('Vendedor')
                    ->options(fn (): array => User::query()
                        ->where('email', 'admin@ecoentrega.com')
                        ->pluck('name', 'id')
                        ->all())
                    ->default(fn () => User::query()->where('email', 'admin@ecoentrega.com')->value('id'))
                    ->afterStateHydrated(fn (Select $component) => $component->state(
                        User::query()->where('email', 'admin@ecoentrega.com')->value('id')
                    ))
                    ->disabled()
                    ->dehydrated()
                    ->required(),
                FileUpload::make('image')
                    ->label('Imagen de la prenda')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->required(),
                DateTimePicker::make('publication_date')
                    ->label('Fecha de publicación')
                    ->default(now())
                    ->required(),
            ]);
    }
}
