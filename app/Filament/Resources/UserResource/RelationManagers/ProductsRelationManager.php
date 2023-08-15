<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Product name')->placeholder('Enter product name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')->label('Product description')->placeholder('Enter product description')
                    ->maxLength(65535)->columnSpan(2),
                Forms\Components\TextInput::make('domain')->label('Domain name')->placeholder('Enter domain name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->label('Email')->placeholder('Enter email address')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->label('Phone number')->placeholder('Enter phone number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')->label('Web address')->placeholder('Enter web address')
                    ->maxLength(255)->url(),

                Forms\Components\Select::make('billing')->options(['daily'=>'Daily','weekly'=>'Weekly','monthly'=>'Monthly','yearly'=>'Yearly','lifetime'=>'Lifetime'])
                    ->required(),
                Forms\Components\TextInput::make('price')->placeholder('Enter product price')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')->required()->placeholder('Select start date'),
                Forms\Components\DatePicker::make('end_date')->required()->placeholder('Select end date'),
                Forms\Components\FileUpload::make('image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pid')->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('billing'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('invoices_count')->counts('invoices'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M d, Y h:i A'),
            ])->defaultSort('end_date','asc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('billing')->options(['daily'=>'Daily','weekly'=>'Weekly','monthly'=>'Monthly','yearly'=>'Yearly','lifetime'=>'Lifetime'])
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
