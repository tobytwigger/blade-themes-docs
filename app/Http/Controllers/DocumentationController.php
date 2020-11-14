<?php

namespace App\Http\Controllers;

use App\Services\DocSchema\Generator;
use App\Services\DocSchema\Schema\AttributeSchema;
use App\Services\DocSchema\Schema\ComponentSchema;
use App\Services\DocSchema\Schema\ExampleSchema;
use App\Services\DocSchema\Schema\GroupSchema;
use App\Services\DocSchema\Schema\SlotSchema;
use Illuminate\Http\Request;
use Twigger\Blade\Foundation\ThemeLoader;

class DocumentationController extends Controller
{

    public function component(string $theme,
                              string $group,
                              string $component,
                              Request $request,
                              ThemeLoader $themeLoader,
                              Generator $generator)
    {
        // Load theme
        $themeLoader->useTagPrefix('docs');
        $themeLoader->load($theme);

        return view('component', [
            'schema' => $generator->generate(),
            'component' => $component,
            'group' => $group
        ]);
    }

}
