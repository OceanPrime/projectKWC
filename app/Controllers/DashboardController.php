<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Dashboard',
        ];
        return view('development/dashboard', $data);
    }


    public function pic()
    {
        $session = session();
        if ($session->get('role') !== 'pic') {
            return redirect()->to('/');
        }
        
        return view('PIC/PIC');
    }
}
