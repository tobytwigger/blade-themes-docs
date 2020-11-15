<?php

namespace App\Http\Controllers;

use App\Services\DocSchema\Factory\ThemeSchemaFactory;
use App\Services\DocSchema\Schema;
use Illuminate\Http\Request;
use Twigger\Blade\Foundation\ThemeLoader;
use Twigger\Blade\Foundation\ThemeStore;

class DocumentationController extends Controller
{

    public function component(string $theme,
                              string $group,
                              string $component,
                              ThemeLoader $themeLoader,
                              ThemeSchemaFactory $schemaFactory,
                              ThemeStore $themeStore)
    {
        // Load theme
        $themeLoader->useTagPrefix('docs');
        $themeLoader->load($theme);

        $themeDefinition = $themeStore->getTheme($theme);

        return view('component', [
            'themeSchema' => $schemaFactory->create($themeDefinition),
            'component' => $component,
            'group' => $group
        ]);
    }

}
