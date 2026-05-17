<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama Produk')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

            TextInput::make('slug')
                ->required()
                ->readOnly(),

            Select::make('category_id')
                ->label('Kategori Produk')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('price')
                ->label('Harga Jual (Rp)')
                ->numeric()
                ->required(),

            TextInput::make('original_price')
                ->label('Harga Coret / Asli (Rp)')
                ->numeric(),

            TextInput::make('stock')
                ->label('Stok')
                ->numeric()
                ->required(),

            Toggle::make('is_popular')
                ->label('Set Sebagai Produk Populer')
                ->default(false),

            TagsInput::make('sizes')
                ->label('Ukuran Tersedia (Pisahkan dengan Enter)')
                ->placeholder('Contoh: 40, 41, 42')
                ->separator(','),

            FileUpload::make('image')
                ->label('Gambar Utama (Thumbnail)')
                ->image()
                ->directory('products')
                ->required()
                ->columnSpanFull(),

            FileUpload::make('images')
                ->label('Galeri Slider (Bisa Upload Banyak)')
                ->image()
                ->multiple()
                ->panelLayout('grid')
                ->directory('products')
                ->columnSpanFull(),

            RichEditor::make('description')
                ->label('Deskripsi Produk')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Foto'),
                TextColumn::make('name')->label('Nama Produk')->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable(),

                IconColumn::make('is_popular')
                    ->label('Populer')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
        ];
    }
}
