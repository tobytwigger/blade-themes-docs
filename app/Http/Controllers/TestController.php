<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TestController extends Controller
{
    public function index()
    {
        Artisan::call('view:clear');
        return view('test');
    }
}
