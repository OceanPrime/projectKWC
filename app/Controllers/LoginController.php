<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_User;

class LoginController extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new M_User();
    }

    public function index()
    {
        return view('login');
    }

    public function Auth()
{
    $UserModel = new M_User();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    
    $user = $UserModel->where('username', $username)->first();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'nama' => $user['nama'],
                'no_hp' => $user['no_hp'],
                'role' => $user['role'],
                'logged_in' => true,
            ]);

            if ($user['role'] == 'admin') {
                return redirect()->to('/dev/dashboard');
            } elseif ($user['role'] == 'teknisi') {
                return redirect()->to('/user/dashboard-user');
            } elseif ($user['role'] == 'customer') {
                return redirect()->to('/customer');
            } else {
                // Masih dalam pengembangan
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Password salah!');
            return redirect()->to('/');
        }
    } else {
        session()->setFlashdata('error', 'Username tidak ditemukan!');
        return redirect()->to('/');
    }
}
}


