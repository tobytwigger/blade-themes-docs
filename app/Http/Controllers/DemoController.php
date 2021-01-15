<?php

namespace App\Http\Controllers;

class DemoController extends Controller
{

    public function show()
    {
        return view('demo.components.all')->withErrors([
            'my-select-2' => ['This is the first error', 'And this is the second!'],
            'date-of-birth' => ['Your date of birth must be in the past']
        ]);
    }

}
