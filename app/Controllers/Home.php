<?php

/*
    Controller não utilizado, mantido para fins didáticos e de integridade
*/

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
