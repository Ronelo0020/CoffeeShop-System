<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Dito natin ituturo sa dashboard file mo
        return view('dashboard');
    }
}