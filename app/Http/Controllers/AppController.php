<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    /**
     * Init all view
     *
     * @return void
     */
    public function __invoke()
    {
        return view('app');
    }
}
