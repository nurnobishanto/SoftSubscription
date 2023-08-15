<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    protected static ?string $recordTitleAttribute = 'invid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user','first_name')->required(),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
