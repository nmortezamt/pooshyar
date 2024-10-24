<?php

namespace Modules\Product\Gallery\Filament\Resources\GalleryResource\Pages;

use Modules\Product\Gallery\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Product\Gallery\Models\Gallery;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if(!$data['position']){
            $position = Gallery::where('product_id', $data['product_id'])
                ->orderBy('position','desc')->first()?->position ?? 0;
            $data['position'] = $position+1;
        }
        return $data;
    }
}
