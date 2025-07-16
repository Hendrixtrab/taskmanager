<?php

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
