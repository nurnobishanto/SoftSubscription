<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user','first_name')->required(),
                Forms\Components\Select::make('product_id')->relationship('product','name')->required(),
                Forms\Components\TextInput::make('amount')->numeric()->required(),
                Forms\Components\Select::make('method')->options(['bkash'=>'Bkash'])->required(),
                Forms\Components\Select::make('status')->options(['pending'=>'Pending','success'=>'Success','failed'=>'Failed','canceled'=>'Canceled'])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invid')->searchable(),
                Tables\Columns\TextColumn::make('user.first_name')->searchable(),
                Tables\Columns\TextColumn::make('product.name')->searchable(),
                Tables\Columns\TextColumn::make('amount')->sortable(),
                Tables\Columns\BadgeColumn::make('method')->sortable(),
                Tables\Columns\BadgeColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->date(),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('method')->options(['bkash'=>'Bkash']),
                Tables\Filters\SelectFilter::make('status')->options(['pending'=>'Pending','success'=>'Success','failed'=>'Failed','canceled'=>'Canceled']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
