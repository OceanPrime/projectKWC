<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DevController extends BaseController
{
    // Manajemen Akun PIC
   public function index()
   {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('development/manajemenAkun/index', $data);
   }

   public function tambahPIC()
   {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('development/manajemenAkun/tambahPIC', $data);
   }

   public function editPIC()
   {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('development/manajemenAkun/editPIC', $data);
   }


   


    // End Manajemen Akun PIC
}

