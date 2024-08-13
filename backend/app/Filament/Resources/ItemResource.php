<?php

namespace App\Filament\Resources;


use App\Models\Item;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\ItemResource\Pages;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                Forms\Components\TextInput::make('starting_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('current_price')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('auction_id')
                    ->relationship('auction', 'name')
                    ->required(),
                Forms\Components\Select::make('winning_bid_id')
                    ->relationship('winningBid', 'amount')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_price')
                    ->sortable()
                    ->money('usd'),
                Tables\Columns\TextColumn::make('current_price')
                    ->sortable()
                    ->money('usd'),
                Tables\Columns\TextColumn::make('auction.name')
                    ->label('Auction')
                    ->sortable(),
                Tables\Columns\TextColumn::make('winningBid.amount')
                    ->label('Winning Bid')
                    ->money('usd'),
            ])
            ->filters([
                // Add filters if necessary
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
