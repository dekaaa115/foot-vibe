<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\ImageColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Pengiriman')->schema([
                Placeholder::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->content(fn ($record) => $record->user->name ?? '-'),

                Placeholder::make('no_hp')
                    ->label('Nomor HP')
                    ->content(fn ($record) => $record->user->phone_number ?? '-'),

                Textarea::make('delivery_address')
                    ->label('Alamat Lengkap Pengiriman')
                    ->columnSpanFull(),

                TextInput::make('tracking_number')
                    ->label('Nomor Resi (Kurir)')
                    ->placeholder('Contoh: JNT123456789')
                    ->columnSpanFull(),
            ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->label('ID Pesanan')
                    ->searchable(),
                TextColumn::make('tracking_number')
                    ->label('No. Resi')
                    ->placeholder('Belum ada resi')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable(),
                TextColumn::make('user.phone_number')
                    ->label('No. HP'),
                TextColumn::make('total_amount')
                    ->label('Total Pembayaran')
                    ->money('IDR'),
                ImageColumn::make('proof_of_payment')
                    ->label('Bukti Transfer'),
                TextColumn::make('discount_amount')
                    ->label('Diskon Voucher')
                    ->money('IDR'),
                SelectColumn::make('status')
                    ->label('Status (Konfirmasi)')
                    ->options([
                        'processing' => 'Menunggu (Processing)',
                        'delivered' => 'Lunas (Delivered)',
                        'cancelled' => 'Batal (Cancelled)',
                    ])
                    ->selectablePlaceholder(false),
                TextColumn::make('created_at')
                    ->label('Tanggal Order')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}
