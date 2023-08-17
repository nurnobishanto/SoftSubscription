<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use App\Models\Product;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredProduct extends BaseWidget
{
    protected static ?int $sort = 3;
    protected function getTableQuery(): Builder
    {
        return Product::query()->where('end_date','<=',date('Y-m-d',strtotime(now())));
    }
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('domain'),
            Tables\Columns\TextColumn::make('end_date'),
        ];
    }
}
