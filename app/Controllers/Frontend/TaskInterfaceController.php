<?php

/*
    Controller utilizado pelo frontend, retorna a view principal ao acessar a rota raíz (/)
*/

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TaskInterfaceController extends BaseController
{
    public function index()
    {
        return view('tasks/index.php');
    }
}
