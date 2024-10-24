<?php

namespace Modules\Product\Size\Filament\Resources\SizeResource\Pages;

use Modules\Product\Size\Filament\Resources\SizeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSize extends EditRecord
{
    protected static string $resource = SizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
