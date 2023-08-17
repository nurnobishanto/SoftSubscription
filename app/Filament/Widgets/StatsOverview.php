<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::all()->count())->description('Sum of all users')->color('success'),
            Card::make('Total Products', Product::all()->count()),
            Card::make('Active Products', Product::where('end_date','>=',date('Y-m-d',strtotime(now())))->get()->count()),
            Card::make('Expired Products', Product::where('end_date','<',date('Y-m-d',strtotime(now())))->get()->count()),
            Card::make('Total Invoice', Invoice::all()->count())->description('Total invoice amount is Tk. '.Invoice::all()->sum('amount'))->color('secondary'),
            Card::make('Paid Invoice', Invoice::where('status','success')->get()->count())->description('Paid invoice amount is Tk. '.Invoice::where('status','success')->get()->sum('amount'))->color('success'),
            Card::make('Pending Invoice', Invoice::where('status','pending')->get()->count())->description('Pending invoice amount is Tk. '.Invoice::where('status','pending')->get()->sum('amount'))->color('warning'),
        ];
    }
}
