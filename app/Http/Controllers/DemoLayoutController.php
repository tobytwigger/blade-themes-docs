<?php

namespace App\Http\Controllers;

class DemoLayoutController extends Controller
{

    public function splash()
    {
        return view('demo.layouts.splash')->withErrors([
            'my-select-2' => ['This is the first error', 'And this is the second!'],
            'date-of-birth' => ['Your date of birth must be in the past']
        ]);
    }

}
