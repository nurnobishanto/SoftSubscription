<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestInvoice extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getTableQuery(): Builder
    {
        return Invoice::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('invid'),
            Tables\Columns\TextColumn::make('trxid'),
            Tables\Columns\TextColumn::make('product.name'),
            Tables\Columns\TextColumn::make('user.first_name'),
            Tables\Columns\TextColumn::make('amount'),
            Tables\Columns\TextColumn::make('method'),
            Tables\Columns\TextColumn::make('status'),
        ];
    }

}
