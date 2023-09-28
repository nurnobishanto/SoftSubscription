<?php

namespace App\Filament\Resources\CheckSubscriptionResource\Pages;

use App\Filament\Resources\CheckSubscriptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCheckSubscriptions extends ListRecords
{
    protected static string $resource = CheckSubscriptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
