<?php

namespace App\Services\DocSchema;

use App\Services\DocSchema\Factory\ThemeSchemaFactory;
use Illuminate\Support\Facades\Facade;

class Schema extends Facade
{

    protected static function getFacadeAccessor()
    {
        return ThemeSchemaFactory::class;
    }

}
