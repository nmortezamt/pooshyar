<?php

namespace Modules\Product\Gallery\Filament\Resources\GalleryResource\Pages;

use Modules\Product\Gallery\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
