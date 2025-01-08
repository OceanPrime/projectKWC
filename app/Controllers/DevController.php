<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DevController extends BaseController
{
    // Monitoring
    public function index()
    {
        return view('development/monitoring/index');
    }
    // End Monitoring

    // Model
    public function model()
    {
        return view('development/model/index');
    }

    public function tambahModel()
    {
        return view('development/model/tambahModel');
    }
    // end Model

    // Costumer
    public function costumer()
    {
        return view('development/costumer/index');
    }

    public function tambahCostumer()
    {
        return view('development/costumer/tambahCostumer');
    }


    //end Costumer
}

