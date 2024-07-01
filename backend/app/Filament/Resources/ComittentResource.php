<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComittentResource\Pages;
use App\Filament\Resources\ComittentResource\RelationManagers;
use App\Models\Comittent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComittentResource extends Resource
{
    protected static ?string $model = Comittent::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('IIN')
                    ->numeric(),
                Forms\Components\TextInput::make('num_udv')
                    ->numeric(),
                Forms\Components\TextInput::make('picture_id')
                    ->numeric(),
                Forms\Components\TextInput::make('entry_price')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('IIN')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_udv')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('picture_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('entry_price')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListComittents::route('/'),
            'create' => Pages\CreateComittent::route('/create'),
            'view' => Pages\ViewComittent::route('/{record}'),
            'edit' => Pages\EditComittent::route('/{record}/edit'),
        ];
    }
}
