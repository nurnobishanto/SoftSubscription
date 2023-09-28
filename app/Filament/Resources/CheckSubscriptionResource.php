<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckSubscriptionResource\Pages;
use App\Filament\Resources\CheckSubscriptionResource\RelationManagers;
use App\Models\CheckSubscription;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckSubscriptionResource extends Resource
{
    protected static ?string $model = CheckSubscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                Tables\Columns\TextColumn::make('domain')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCheckSubscriptions::route('/'),
            'create' => Pages\CreateCheckSubscription::route('/create'),
            'edit' => Pages\EditCheckSubscription::route('/{record}/edit'),
        ];
    }
}
