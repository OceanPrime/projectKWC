<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()//admin
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

// KHUSUS ROLE PIC
    public function ReDrawing()
    {
        $session = session();
        if ($session->get('role') !== 'ReDrawing') {
            return redirect()->to('/');
        } 
        
        return view('PIC/ReDrawing/dashboard');
    }

    public function ApprovalReDraw()
    {
        $session = session();
        if ($session->get('role') !== 'ApprovalReDraw') {
            return redirect()->to('/');
        } 

        return view('PIC/ApprovalReDraw/dashboard');
    }

    public function indexApprovalReDraw()
    {
        $session = session();
        if ($session->get('role') !== 'ApprovalReDraw') {
            return redirect()->to('/');
        } 

        return view('PIC/ApprovalReDraw/task/index');
    }

    public function editApprovalReDraw()
    {
        return view('PIC/ApprovalReDraw/edit');
    }

    // END KHUSUS ROLE PIC
}
