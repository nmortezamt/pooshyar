<?php

namespace Modules\Product\Size\Filament\Resources\SizeResource\Pages;

use Modules\Product\Size\Filament\Resources\SizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSizes extends ListRecords
{
    protected static string $resource = SizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
