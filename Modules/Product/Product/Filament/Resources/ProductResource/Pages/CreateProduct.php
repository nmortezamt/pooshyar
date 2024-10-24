<?php

namespace Modules\Product\Product\Filament\Resources\ProductResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Product\Product\Filament\Resources\ProductResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
